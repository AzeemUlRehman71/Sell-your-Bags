<?php

namespace App\Http\Controllers;

use App\Models\ConditionReport;
use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Jobs\SendPoEmail;
use App\Mail\ThankYou;
use App\Models\Product;
use App\Models\TemporarayFile;
use App\Models\UpdateLog;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use GuzzleHttp\Handler\Proxy;

//use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\Count;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Response;

use App\Libraries\Barcode;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Client $client)
    // {
    //     $list = $client->getAllClientsWithProducts();
    //     $data = DB::table('users_role')->where('user_role', Auth::user()->user_role)->get();
    //     return view('backend.client.index_2024_08_26', compact('list', 'data'));
    // }

    public function index(Client $client)
    {
        $data = DB::table('users_role')->where('user_role', Auth::user()->user_role)->get();
        return view('backend.client.index', compact('data'));
    }

    public function posDatatables(Request $request)
    {
        $statusList = @include(app_path('status.php'));

        $limit = (int) $request->input('length');
        $start = (int) $request->input('start');

        $columns = $request->input('columns');
        $order = $columns[$request->input('order.0.column')]['data'];
        $dir   = $request->input('order.0.dir');

        $searchBy = $request->input('search.value');

        // $list = [];
        if (!empty($searchBy)) {
            $list = Client::with('product')
                ->withCount('updateLog')
                ->where(function ($q) use($searchBy) {
                    $q->where('name', 'like', '%' . $searchBy . '%')
                    ->orWhere('email', 'like', '%' . $searchBy . '%')
                    ->orWhere('tracking', 'like', '%' . $searchBy . '%')
                    ->orWhere('po_number', 'like', '%' . $searchBy . '%')
                    ->orWhere('client_status', 'like', '%' . $searchBy . '%')
                    ->orWhere('user_create', 'like', '%' . $searchBy . '%')
                    ->orWhere(function($q1) use($searchBy) {
                        $q1->whereHas('product', function ($query) use ($searchBy) {
                            $query->where('name', 'like', '%' . $searchBy . '%')
                            ->orWhere('sku', 'like', '%' . $searchBy . '%');
                        });
                    });
                });


            $recordsFiltered = $list->count();
            $recordsTotal = Client::count();
        } else {
            $list = Client::with('product')
                ->withCount('updateLog');

            $recordsFiltered = $list->count();
            $recordsTotal = $recordsFiltered;
        }

        $listCount = $list->count();

        if ($order != 'product_name') {
            $list = $list->orderBy($order, $dir);
        } else {
            $list = $list->orderBy('po_number', $dir);
        }

        $list = $list->skip($start)
                ->take($limit)
                ->get();

        $data = [];
        foreach ($list as $item) {
            $data[] = [
                'id' => $item->id,
                'po_number' => $item->po_number,
                'name' => $item->name,
                'product_name' => $item->product->implode('name', "\n"),
                'created_at' => date('m-d-Y H:i:s', strtotime($item->created_at)),
                'client_status' => '<span class="badge rounded-pill ' . (isset($statusList[$item->client_status]) ? $statusList[$item->client_status] : 'badge-light-secondary') . ' text-capitalized="">'. $item->client_status . '</span>',
                'user_create' => $item->user_create,
                'action_button' => '<button class="btn btn-sm btn-outline-primary" style="padding: 0.486rem .5rem;" onclick="showHistory(' . $item->id . ')" data-bs-toggle="tooltip" data-bs-placement="top" title="Update Log">' . $item->update_log_count . '</button>',
            ];
        }


        return json_encode([
                "draw" => intval($request->draw),
                "recordsTotal" => $recordsTotal,
                "recordsFiltered" => $recordsFiltered,
                'data' => $data,
            ]);
    }

    public function all(Client $client)
    {
        // $list = $client->getAllClientsWithProducts();
        $data = DB::table('users_role')->where('user_role', Auth::user()->user_role)->get();
        // return view('backend.client.all', compact('list', 'data'));
        return view('backend.client.all', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend/pages/sellyourbags');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function filepondprocess(Request $request)
    {
        $products = $request->products;
        if ($request->has('id_card_image')) {
            $idcard = $request->file('id_card_image');
            $file_name = $idcard->getClientOriginalName();
            $folder = uniqid('post', true);

            //saving images in storage but giveing issues on production
            //$idcard->storeAs('posts/tmp/' .$folder,$file_name);

            //so saving images in Public folder now
            $idcard->move(public_path('posts/tmp/') . $folder, $file_name);
            TemporarayFile::create([
                'folder' => $folder,
                'file' => $file_name
            ]);

            return $folder;
        }

        if (isset($request->images) && (!empty($request->images[0]))) {
            $product1 = $request->images[0];
            $file_name = $product1->getClientOriginalName();
            $folderProduct1 = uniqid('product', true);
            $product1->move(public_path('products/tmp/') . $folderProduct1, $file_name);
            TemporarayFile::create([
                'folder' => $folderProduct1,
                'file' => $file_name
            ]);

            return Response::make($folderProduct1, 200, [
                'Access-Control-Expose-Headers' => 'Content-Disposition, Content-Length, X-Content-Transfer-Id',
                // 'Content-Type' => mime_content_type($path),
                // 'Content-Length' => filesize($path),
                // 'Content-Disposition' => 'inline; products[0]["images"][]="' . $folderProduct1 . '"',
                // 'X-Content-Transfer-Id' => $folderProduct1
            ]);
            // return $folderProduct1;
        }

        if ((!empty($products[0]["'image'"][0]))) {
            $product1 = $products[0]["'image'"][0];
            $file_name = $product1->getClientOriginalName();
            $folderProduct1 = uniqid('product', true);
            //$product1->storeAs('products/tmp/' .$folderProduct1,$file_name);
            $product1->move(public_path('products/tmp/') . $folderProduct1, $file_name);
            TemporarayFile::create([
                'folder' => $folderProduct1,
                'file' => $file_name
            ]);

            return Response::make($folderProduct1, 200, [
                'Access-Control-Expose-Headers' => 'Content-Disposition, Content-Length, X-Content-Transfer-Id',
                // 'Content-Type' => mime_content_type($path),
                // 'Content-Length' => filesize($path),
                'Content-Disposition' => 'inline; products[0]["images"][]="' . $folderProduct1 . '"',
                'X-Content-Transfer-Id' => $folderProduct1
            ]);
            // return $folderProduct1;
        }
        if ((!empty($products[1]["'image'"][0]))) {

            $product2 = $products[1]["'image'"][0];
            $file_name = $product2->getClientOriginalName();
            $folderProduct2 = uniqid('product', true);
            //$product2->storeAs('products/tmp/' .$folderProduct2,$file_name);
            $product2->move(public_path('products/tmp/') . $folderProduct2, $file_name);
            TemporarayFile::create([
                'folder' => $folderProduct2,
                'file' => $file_name
            ]);

            return $folderProduct2;
        }
        if ((!empty($products[2]["'image'"][0]))) {

            $product3 = $products[2]["'image'"][0];
            $file_name = $product3->getClientOriginalName();
            $folderProduct3 = uniqid('product', true);
            //  $product3->storeAs('products/tmp/' .$folderProduct3,$file_name);
            $product3->move(public_path('products/tmp/') . $folderProduct3, $file_name);

            TemporarayFile::create([
                'folder' => $folderProduct3,
                'file' => $file_name
            ]);

            return $folderProduct3;
        }

        foreach ($products as $itemKey => $productItem) {
            $productNew = $products[$itemKey]["'image'"][0];
            $file_name = $productNew->getClientOriginalName();
            $folderProductNew = uniqid('product', true);
            //  $product3->storeAs('products/tmp/' .$folderProduct3,$file_name);
            $productNew->move(public_path('products/tmp/') . $folderProductNew, $file_name);

            TemporarayFile::create([
                'folder' => $folderProductNew,
                'file' => $file_name
            ]);

            return $folderProductNew;
        }
        return '';
    }
    public function filepondDelete(Request $request)
    {

        $fileId = request()->getContent();
        $productDel = Str::startsWith($fileId, 'product');
        $postDel = Str::startsWith($fileId, 'post');

        if ($productDel) {
            $tmp_file = TemporarayFile::where('folder', $fileId)->first();
            if ($tmp_file) {
                //  Storage::deleteDirectory('/products/tmp/' .$tmp_file->folder);
                File::deleteDirectory(public_path('/products/tmp/') . $tmp_file->folder);
                $tmp_file->delete();
            }
        }
        if ($postDel) {
            $tmp_file = TemporarayFile::where('folder', $fileId)->first();
            if ($tmp_file) {
                // $realPath1=$tmp_file->folder . '/' .$tmp_file->file;
                //   Storage::deleteDirectory('/posts/tmp/' .$tmp_file->folder);
                File::deleteDirectory(public_path('/posts/tmp/') . $tmp_file->folder);
                $tmp_file->delete();
            }
        }
    }



    public function filepondRestore(Request $request, string $id)
    {

        //$fileId = $request->id;
        // dd($fileId);

        // $path = 'posts/tmp/'.$id.'/presentation_1.png';
        // dd(storage_path());
        // dd($path);
        // if (file_exists(storage_path().'/app/posts/tmp/'.$id.'/presentation_1.png')) {
        //     dd('File  Exists');
        //   }else{
        //     dd('File  Not Exists');
        //   }

        // dd(Storage::disk('local')->exists($path));
        //  if (Storage::exists(storage_path().'/app/posts/tmp/'.$id.'/presentation_1.png')) {
        //     dd('File  Exists');
        //   }else{
        //     dd('File  Not Exists');
        //   }


        // $heredisk = config('filesystems.disks.local.root');
        //dd($heredisk);

        // $path = 'posts/tmp/'.$id.'/presentation_1.png';
        // dd($path);

        // $mime = Storage::disk('local')->mimeType($path);
        // $file = Storage::disk('local')->get($path);

        // return Response::make($file, 200, [
        //     'Content-Type' => $mime,
        //     'Content-Disposition' => 'inline; filename="'.$id.'"',
        // ]);



    }
    public function store(Request $request)
    {
        $formNo = config('constants.options.Form_No');
        $clientsCount = DB::table('clients')->count();
        if ($clientsCount > 0) {

            $clientLast = Client::orderBy('po_number', 'desc')->first();
            $lastPo = $clientLast->po_number;
            $poNumberNext = $lastPo + 1;
        } else {
            $poNumberNext = config('constants.options.Form_No');
        }

        $input = $request->all();
        $file = $request->file('productImage');

        $ids = $request->productName;

        if ($request->payment_method == 'direct') {

            $payment_name = $request->payment_full_name;
            $payment_email = $request->payment_email;
            $payment_direct_phone_number = $request->payment_direct_phone_number;
            $payment_direct_account_number = $request->payment_direct_account_number;
            $payment_direct_routing_number = $request->payment_direct_routing_number;
            $payment_direct_account_type = $request->payment_direct_account_type;
            $payment_direct_bank_name = $request->payment_direct_bank_name;
        }
        if ($request->payment_method == 'paypal') {
            $payment_name = $request->payment_name_paypal;
            $payment_email = $request->payment_email_paypal;
        }
        if ($request->payment_method == 'cheque') {
            $payment_name = $request->payment_full_name_cheque;
            $payment_email = $request->payment_email_cheque;
        }
        if ($request->payment_method == 'echeck') {
            $payment_name = $request->payment_full_name_echeck;
            $payment_email = $request->payment_email_echeck;
        }
        if ($request->payment_method == 'storecredit') {
            $store_credit = $request->storecredit;
            $payment_name = $request->payment_full_name;
            $payment_email = $request->payment_email;
            $payment_direct_phone_number = $request->payment_direct_phone_number;
            $payment_direct_account_number = $request->payment_direct_account_number;
            $payment_direct_routing_number = $request->payment_direct_routing_number;
            $payment_direct_account_type = $request->payment_direct_account_type;
            $payment_direct_bank_name = $request->payment_direct_bank_name;
        }

        $folderPath = public_path('signature/');
        $imageParts = explode(";base64,", $request->signature64);
        $imageTypeAux = explode("image/", $imageParts[0]);
        $imageType = $imageTypeAux[1];
        $imageBase64 = base64_decode($imageParts[1]);
        $imageName = 'signature' . '_' . microtime() . '.' . $imageType;
        $file = $folderPath . $imageName;
        file_put_contents($file, $imageBase64);



        $tmp_file = TemporarayFile::where('folder', $request->id_card_image)->first();

        $realPath1 = '';
        if ($tmp_file) {

            Storage::copy('/posts/tmp/' . $tmp_file->folder . '/' . $tmp_file->file, '/idcard/' . $tmp_file->folder . '/' . $tmp_file->file);

            $realPath1 = $tmp_file->folder . '/' . $tmp_file->file;
            File::deleteDirectory(public_path('/posts/tmp/') . $tmp_file->folder);
            $tmp_file->delete();
        }

        $client = new Client();

        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->phone = $request->input('phone');
        $client->address = $request->input('address');
        $client->user_create = Auth::user()->name;
        $client->id_card_image = $realPath1 ?? null;
        $client->payment_method = $request->input('payment_method');
        $client->payment_full_name = $payment_name;
        $client->payment_email = $payment_email;
        $client->payment_direct_phone_number = $payment_direct_phone_number ?? null;
        $client->payment_direct_account_number = $payment_direct_account_number ?? null;
        $client->payment_direct_routing_number = $payment_direct_routing_number ?? null;
        $client->payment_direct_account_type = $payment_direct_account_type ?? null;
        $client->payment_direct_bank_name = $payment_direct_bank_name ?? null;
        $client->store_credit = $store_credit ?? null;
        $client->client_status = 'Pending';
        $client->total_amount = $request->input('grand_total');
        $client->signature = $imageName;
        $client->disclaimer = 1;
        $client->po_number = $poNumberNext;
        $client->note = $request->input('note');

        $client->save();

        $lastId = $client->id;
        $newPo = $client->po_number;
        $condition = $request->productImage;
        $products = $request->products;

        $newArray = collect($products)->reject(function ($product) {
            return is_null($product["'name'"]) && is_null($product["'condition'"]) && is_null($product["'price'"]);
        });

        foreach ($newArray as $product) {
            $images = [];
            if ((!empty($product["'image'"]))) {
                foreach ($product["'image'"] as $image) {
                    $tmp_file = TemporarayFile::where('folder', $image)->first();
                    if ($tmp_file) {
                        Storage::copy('/products/tmp/' . $tmp_file->folder . '/' . $tmp_file->file, '/product/' . $tmp_file->folder . '/' . $tmp_file->file);
                        $realPath = $tmp_file->folder . '/' . $tmp_file->file;
                        array_push($images, $realPath);
                        File::deleteDirectory(public_path('/products/tmp/') . $tmp_file->folder);
                        $tmp_file->delete();
                    }
                }

            }

            $productNew = new Product();
            $productNew->sku = $this->generateSKU();
            $productNew->name = $product["'name'"] ?? '';
            // ;
            $productNew->condition = $product["'condition'"] ?? '';
            $productNew->price = $product["'price'"];
            $productNew->client_id = $lastId;
            // $productNew->image_path = $realPath ?? '';
            $productNew->image_path = json_encode($images);
            $productNew->save();
        }

        $clientDetails = Client::with('product')->find($lastId);

        return redirect()->route('sellyourbags.thankyou', ['id' => $lastId, 'po' => $newPo]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id, Client $client)
    {
        $clientDetails = $client->getClientDetailsById($id);
        $backClient = Client::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $nextClient = Client::where('id', '>', $id)->orderBy('id', 'asc')->first();

        return view('backend/client/view', ['clientDetails' => $clientDetails, 'backClient' => $backClient, 'nextClient' => $nextClient]);
    }

    public function showimg($folder, $img)
    {
        $folders = $folder;
        $imgs = $img;
        return view('backend/client/view', ['folders' => $folders]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */

    public function editProductUnit(Request $request)
    {
        $this->validate($request, [

            'edit_product_id' => 'required',
            'client_status' => 'required'
        ]);

        DB::beginTransaction();
        try {

            $client = Client::where('id', $request->edit_product_id)->first();

            $updateFields = [];
            $updateCommonFields = [
                'model' => 'Client',
                'model_id' => $client->id,
                'updated_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($client->client_status != $request->client_status) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Status',
                    'old_value' => $client->client_status,
                    'new_value' => $request->client_status,
                ]);
            }

            if (!empty($updateFields)) {
                UpdateLog::insert($updateFields);
            }

            Client::where('id', $client->id)->update([
                'client_status' => $request->client_status
            ]);

            DB::commit();
            return redirect()->back()->with('clientupdated', __('Client Status Updated Successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', __('Something went Wrong'));
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */

    public function editProductDetails(Request $request)
    {
        $this->validate($request, [
            'productPrice_value' => 'required',
            'images[]' => 'sometimes|string',
        ]);

        DB::beginTransaction();
        try {

            $product = Product::where('id', $request->edit_product_id_value)->first();
            $string = $product->image_path ? json_decode($product->image_path, true)[0] : "";
            
            //Get the product folder name i-e extract from it
            $token = strtok($string, "/"); // Output
            $path = realpath("product/" . $token);
            if (!is_dir($path))
                $token = "";
            $client = Client::where('id', $request->client_id_value)->first();
            $images = [];
            if ((isset($request["images"]))) {
                foreach ($request["images"] as $image) {
                    $tmp_file = TemporarayFile::where('folder', $image)->first();
                    if ($tmp_file) {
                        Storage::copy('/products/tmp/' . $tmp_file->folder . '/' . $tmp_file->file, '/product/' . $tmp_file->folder . '/' . $tmp_file->file);
                        $realPath = $tmp_file->folder . '/' . $tmp_file->file;
                        array_push($images, $realPath);
                        File::deleteDirectory(public_path('/products/tmp/') . $tmp_file->folder);
                        $tmp_file->delete();
                    }
                }

            }

            $preImages = [];
            if ($product->image_path) {
                $preImages = json_decode($product->image_path);
            }

            $updatedImages = array_merge($preImages, $images);

            Product::where('id', $product->id)->update([

                'condition' => $request->productCondition ?? null,
                'price' => $request->productPrice_value,
                'name' => $request->productName ?? null,
                // 'image_path' => count($images) ? json_encode($images) : $product->image_path
                'image_path' => json_encode(array_slice($updatedImages, -3, 3))
            ]);

            $productAll = Product::all()->where('client_id', '=', $request->client_id_value);

            $sum = 0;
            foreach ($productAll as $calProduct) {

                $sum += $calProduct['price'];
            }

            Client::where('id', $client->id)->update([

                'total_amount' => $sum,
            ]);
            DB::commit();

            return redirect()->back()->with('productUpdated', __('Product Updated Successfully'));
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);

            return redirect()->back()->with('danger', __('Something went Wrong'));
        }
    }

    public function editClient($id)
    {

        $clientDetails = Client::with('product')->find($id);

        return view('backend/client/edit', ['clientDetails' => $clientDetails]);
    }

    /**
     * Update a  resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateClientRequest $request, $id)
    {
        DB::beginTransaction();
        try {

            $client = Client::where('id', $request->id)->first();
            $string = $client->id_card_image;
            $token = strtok($string, "/"); // Output: Thequickbrown

            if ($request->has('id_card_image')) {
                $originalImage = $request->file('id_card_image');
                $thumbnailImage = Image::make($originalImage);
                $thumbnailPath = 'idcard/' . $token . '/';
                // $originalPath = public_path().'/images/';
                //$thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
                // $thumbnailImage->resize(400, 200);
                // $thumbnailImage->resize(500, 350, function ($constraint) {
                //     $constraint->aspectRatio();
                //     $constraint->upsize();
                // });
                $thumbnailImage->fit(600, 360, function ($constraint) {
                    $constraint->upsize();
                });
                $thumbnailImage->save($thumbnailPath . time() . $originalImage->getClientOriginalName());
                // $realPath =time().$originalImage->getClientOriginalName();
                $realPath = $token . '/' . time() . $originalImage->getClientOriginalName();
                Client::where('id', $client->id)->update([
                    'id_card_image' => $realPath,
                ]);
            }

            if ($request->filled('signature64')) {
                $folderPath = public_path('signature/');
                $imageParts = explode(";base64,", $request->signature64);
                $imageTypeAux = explode("image/", $imageParts[0]);
                $imageType = $imageTypeAux[1];
                $imageBase64 = base64_decode($imageParts[1]);
                $imageName = 'signature' . '_' . microtime() . '.' . $imageType;
                $file = $folderPath . $imageName;
                file_put_contents($file, $imageBase64);
            }

            if ($request->payment_method == 'direct') {

                $payment_name = $request->payment_full_name;
                $payment_email = $request->payment_email;
                $payment_direct_phone_number = $request->payment_direct_phone_number;
                $payment_direct_account_number = $request->payment_direct_account_number;
                $payment_direct_routing_number = $request->payment_direct_routing_number;
                $payment_direct_account_type = $request->payment_direct_account_type;
                $payment_direct_bank_name = $request->payment_direct_bank_name;
            }
            if ($request->payment_method == 'paypal') {
                $payment_name = $request->payment_name_paypal;
                $payment_email = $request->payment_email_paypal;
            }
            if ($request->payment_method == 'cheque') {
                $payment_name = $request->payment_full_name_cheque;
                $payment_email = $request->payment_email_cheque;
            }
            if ($request->payment_method == 'echeck') {
                $payment_name = $request->payment_full_name_echeck;
                $payment_email = $request->payment_email_echeck;
            }
            if ($request->payment_method == 'storecredit') {
                $store_credit = $request->storecredit;
                $payment_name = $request->payment_full_name;
                $payment_email = $request->payment_email;
                $payment_direct_phone_number = $request->payment_direct_phone_number;
                $payment_direct_account_number = $request->payment_direct_account_number;
                $payment_direct_routing_number = $request->payment_direct_routing_number;
                $payment_direct_account_type = $request->payment_direct_account_type;
                $payment_direct_bank_name = $request->payment_direct_bank_name;
            }

            $updateFields = [];
            $updateCommonFields = [
                'model' => 'Client',
                'model_id' => $client->id,
                'updated_by' => auth()->user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($client->name != $request->name) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Name',
                    'old_value' => $client->name,
                    'new_value' => $request->name,
                ]);
            }

            if ($client->email != $request->email) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Email',
                    'old_value' => $client->email,
                    'new_value' => $request->email,
                ]);
            }

            if ($client->phone != $request->phone) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Phone',
                    'old_value' => $client->phone,
                    'new_value' => $request->phone,
                ]);
            }

            if ($client->address != $request->address) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Address',
                    'old_value' => $client->address,
                    'new_value' => $request->address,
                ]);
            }

            if ($client->tracking != $request->tracking) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Tracking',
                    'old_value' => $client->tracking,
                    'new_value' => $request->tracking,
                ]);
            }

            if ($client->payment_method != $request->payment_method) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Payment Method',
                    'old_value' => $client->payment_method,
                    'new_value' => $request->payment_method,
                ]);
            }

            if ($client->payment_full_name != ($payment_name ? $payment_name : $request->payment_full_name)) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Payment Full Name',
                    'old_value' => $client->payment_full_name,
                    'new_value' => ($payment_name ? $payment_name : $request->payment_full_name),
                ]);
            }

            if ($client->payment_email != ($payment_email ? $payment_email : $request->payment_email)) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Payment Email',
                    'old_value' => $client->payment_email,
                    'new_value' => ($payment_email ? $payment_email : $request->payment_email),
                ]);
            }

            if ($client->payment_direct_phone_number != ($payment_direct_phone_number ?? $request->payment_direct_phone_number)) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Payment Phone Number',
                    'old_value' => $client->payment_direct_phone_number,
                    'new_value' => ($payment_direct_phone_number ?? $request->payment_direct_phone_number),
                ]);
            }

            if ($client->payment_direct_account_number != ($payment_direct_account_number ?? $request->payment_direct_account_number)) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Payment Account Number',
                    'old_value' => $client->payment_direct_account_number,
                    'new_value' => ($payment_direct_account_number ?? $request->payment_direct_account_number),
                ]);
            }

            if ($client->payment_direct_routing_number != ($payment_direct_routing_number ?? $request->payment_direct_routing_number)) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Payment Routing Number',
                    'old_value' => $client->payment_direct_routing_number,
                    'new_value' => ($payment_direct_routing_number ?? $request->payment_direct_routing_number),
                ]);
            }

            if ($client->payment_direct_account_type != ($payment_direct_account_type ?? $request->payment_direct_routing_number)) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Payment Account Type',
                    'old_value' => $client->payment_direct_account_type,
                    'new_value' => ($payment_direct_account_type ?? $request->payment_direct_account_type),
                ]);
            }

            if ($client->payment_direct_bank_name != ($payment_direct_bank_name ?? $request->payment_direct_bank_name)) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Payment Bank Name',
                    'old_value' => $client->payment_direct_bank_name,
                    'new_value' => ($payment_direct_bank_name ?? $request->payment_direct_bank_name),
                ]);
            }

            if ($client->store_credit != ($store_credit ?? $request->storecredit)) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Store Credit',
                    'old_value' => $client->store_credit,
                    'new_value' => ($store_credit ?? $request->storecredit),
                ]);
            }

            if ($client->note != $request->note) {
                $updateFields[] = array_merge($updateCommonFields, [
                    'field' => 'Note',
                    'old_value' => $client->note,
                    'new_value' => $request->note,
                ]);
            }

            if (!empty($updateFields)) {
                UpdateLog::insert($updateFields);
            }

            Client::where('id', $client->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'user_create' => Auth::user()->name,
                'payment_method' => $request->payment_method,
                'payment_full_name' => $payment_name ? $payment_name : $request->payment_full_name,
                'payment_email' => $payment_email ? $payment_email : $request->payment_email,
                'payment_direct_phone_number' => $payment_direct_phone_number ?? $request->payment_direct_phone_number,
                'payment_direct_account_number' => $payment_direct_account_number ?? $request->payment_direct_account_number,
                'payment_direct_routing_number' => $payment_direct_routing_number ?? $request->payment_direct_routing_number,
                'payment_direct_account_type' => $payment_direct_account_type ?? $request->payment_direct_account_type,
                'payment_direct_bank_name' => $payment_direct_bank_name ?? $request->payment_direct_bank_name,
                'store_credit' => $store_credit ?? $request->storecredit,
                'signature' => $imageName ?? $request->oldsignature,
                'note' => $request->note,
                'tracking' => $request->tracking,
            ]);

            DB::commit();

            return redirect()->back()->with('clientdetailsupdated', __('Client Details Updated Successfully'));
        } catch (\Exception $e) {
            // dd($e);

            DB::rollback();

            return redirect()->back()->with('danger', __('Something went Wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }

    public function thankyou($id)
    {
        return view('frontend/pages/thankyou', ['id' => $id]);
    }

    public function print($id)
    {
        $clientDetails = Client::with('product')->find($id);

        $generator = new Barcode();

        header("Content-Type: image/svg+xml");
        $svg = $generator->render_svg('code-39', $clientDetails->po_number, ['sx' => 1, 'sy' => .4, 'ts' => 10, 'pt' => 5]);

        file_put_contents(public_path('/barcode/po_' . $clientDetails->po_number . '.svg'), $svg);

        return view('frontend/pages/thankyouprint', ['clientDetails' => $clientDetails]);
    }

    public function deleteImage(Request $request)
    {
        $product = Product::find($request->product_id);

        if ($product && isset($product->image_path)) {
            $imagePath = json_decode($product->image_path);
            if (isset($imagePath[$request->image_index])) {
                unset($imagePath[$request->image_index]);

                $product->image_path = json_encode(array_values($imagePath));
                $product->save();

                return response()->json(1);
            }
        }
        return response()->json(0);
    }

   public function tagged ($id) {
      $client = Client::find($id);
      if (!empty($client)) {
         if ($client->tagged == 1) {
            $client->tagged = 0;
         } else {
            $client->tagged = 1;
         }
         $client->save();
      }

      return response()->json($client);
   }

   public function taggedProductItem ($id) {
      $product = Product::find($id);
      if (!empty($product)) {
         if ($product->tagged == 1) {
            $product->tagged = 0;
         } else {
            $product->tagged = 1;
         }
         $product->save();
      }

      return response()->json($product);
   }

    public function barcodePrint($id, Client $client)
    {
        //$client = Client::find($id);

        $client = $client->getClientDetailsById($id);

        $generator = new Barcode();

        header("Content-Type: image/svg+xml");
        $svg = $generator->render_svg('code-128', $client->po_number, ['sx' => 1, 'sy' => .4, 'ts' => 10, 'pt' => 5, 'pl' => 2, 'pr' => 2]);

        file_put_contents(public_path('/barcode/' . $client->po_number . '.svg'), $svg);

        foreach ($client->product as $key => $item) {
            if (isset($item->sku) && $item->sku) {
                header("Content-Type: image/svg+xml");
                $svg = $generator->render_svg('code-128', $item->sku, ['sx' => 1, 'sy' => .4, 'ts' => 10, 'pt' => 5, 'pl' => 2, 'pr' => 2]);

                file_put_contents(public_path('/barcode/' . $item->sku . '.svg'), $svg);
        
            }
        }

        return view('frontend/pages/barcodeprint', ['id' => $id, 'client' => $client]);

    }

    public function updateHistory($id)
    {
        $updateLogs = UpdateLog::where('model_id', $id)->orderBy('created_at', 'desc')->get();
        $updateLogTables = '';

        foreach ($updateLogs as $updateLog) {
            $updateLogTables .= "<tr>";
            $updateLogTables .= "<td style='width: 15%; word-break: break-all;'>" . date('Y-m-d h:i a', strtotime($updateLog->created_at)) . "</td>";
            $updateLogTables .= "<td style='width: 20%; word-break: break-all;'>" . $updateLog->field . "</td>";
            $updateLogTables .= "<td style='width: 25%; word-break: break-all;'>" . $updateLog->old_value . "</td>";
            $updateLogTables .= "<td style='width: 25%; word-break: break-all;'>" . $updateLog->new_value . "</td>";
            $updateLogTables .= "<td style='width: 15%; word-break: break-all;'>" . (isset($updateLog->user) ? $updateLog->user->name : '') . "</td>";
            $updateLogTables .= "</tr>";
        }

        return response()->json($updateLogTables);
    }

    public function generateSKU() {
        $lastProduct = Product::orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->first();
        if (!empty($lastProduct) && isset($lastProduct->sku) && $lastProduct->sku) {
            $lastSKU = $lastProduct->sku;
            $lastSKU = str_replace("DD", "", $lastSKU);
            ++$lastSKU;
            $newSKU = 'DD' . $lastSKU;

            $findProduct = Product::where('sku', $newSKU)->first();
            if (!empty($findProduct)) {
                return $this->generateSKU();
            }

            return $newSKU;
        }
        return 'DD19300';
    }

    public function saveConditionReport(Request $request)
    {
        // dd($request->all());
        // $checkboxFields = [
        //     'eb_cb_color', 'eb_cb_sign_of_use', 'eb_cb_scratches', 'eb_cb_peeling',
        //     'eb_cb_color_transfer', 'eb_cb_body_rubbing_marks', 'eb_cb_loose_threads', 'eb_cb_wear_on_corners_edges',
        //     'eb_cb_bag_out_of_shapes', 'eb_cb_signs_on_handles_straps', 'eb_cb_cracking', 'eb_cb_repainted',
        //     'hw_cb_color', 'hw_cb_excellent', 'hw_cb_discoloration', 'hw_cb_scrateches',
        //     'hw_cb_sign_of_use', 'in_cb_smell', 'in_cb_clean_excellent', 'in_cb_stains',
        //     'in_cb_tears', 'in_cb_no_make_in', 'in_cb_date_code', 
        // ];

        $data = $request->except([
            '_token', 'product_id', 'inspection_type', 'no_make_in',
            'date_code', 'measurement_w', 'measurement_d', 'measurement_h',
            'notes'
        ]);

        foreach ($data as $key => $value) {
            $data[$key] = json_encode($value);
        }

        $data['no_make_in'] = $request->no_make_in;
        $data['date_code'] = $request->date_code;
        $data['measurement_w'] = $request->measurement_w;
        $data['measurement_d'] = $request->measurement_d;
        $data['measurement_h'] = $request->measurement_h;
        $data['notes'] = $request->notes;

        // $data = $request->except(['_token', 'client_id', 'inspection_type']);
        // $data['accessories'] = isset($data['accessories']) ? json_encode($data['accessories']) : json_encode([]);

        // $missingCheckboxFields = array_diff($checkboxFields, array_keys($data));
        // foreach ($missingCheckboxFields as $field) {
        //     $data[$field] = 0;
        // }

        ConditionReport::updateOrCreate(
            ['product_id' => $request->product_id, 'inspection_type' => $request->inspection_type],
            $data
        );

        return response()->json([
            'status' => true
        ]);
    }

    public function fetchConditionReport($id)
    {
        $firstInspection = ConditionReport::where('product_id', $id)
            ->where('inspection_type', 'first-inspection')
            ->orderBy('created_at', 'desc')
            ->first();

        $secondInspection = ConditionReport::where('product_id', $id)
            ->where('inspection_type', 'second-inspection')
            ->orderBy('created_at', 'desc')
            ->first();

        $thirdInspection = ConditionReport::where('product_id', $id)
            ->where('inspection_type', 'third-inspection')
            ->orderBy('created_at', 'desc')
            ->first();

        return response()->json([
            'first_inspection' => view('backend.client.modal._form_condition_report', [
                    'productId' => $id,
                    'title' => 'Customer Inspection',
                    'formId' =>'first-inspection',
                    'inspectionType' => 'first-inspection',
                    'data' => $firstInspection
                ])->render(),
            'second_inspection' => view('backend.client.modal._form_condition_report', [
                    'productId' => $id,
                    'title' => 'Incoming Inspection',
                    'formId' =>'second-inspection',
                    'inspectionType' => 'second-inspection',
                    'data' => $secondInspection
                ])->render(),
            'third_inspection' => view('backend.client.modal._form_condition_report', [
                    'productId' => $id,
                    'title' => 'Listing Inspection',
                    'formId' =>'third-inspection',
                    'inspectionType' => 'third-inspection',
                    'data' => $thirdInspection
                ])->render()
        ]);
    }

    public function fetchComparisonReport($id)
    {
        $firstInspection = ConditionReport::where('product_id', $id)
            ->where('inspection_type', 'first-inspection')
            ->orderBy('created_at', 'desc')
            ->first();

        $secondInspection = ConditionReport::where('product_id', $id)
            ->where('inspection_type', 'second-inspection')
            ->orderBy('created_at', 'desc')
            ->first();

        $thirdInspection = ConditionReport::where('product_id', $id)
            ->where('inspection_type', 'third-inspection')
            ->orderBy('created_at', 'desc')
            ->first();

        return response()->json([
            'comparison_report' => view('backend.client.modal.condition_comparison_report',[
                'firstInspection' => $firstInspection,
                'secondInspection' => $secondInspection,
                'thirdInspection' => $thirdInspection,
            ])->render()
        ]);
    }


    
}
