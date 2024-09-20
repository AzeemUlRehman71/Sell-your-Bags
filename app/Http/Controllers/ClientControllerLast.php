<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Jobs\SendPoEmail;
use App\Mail\ThankYou;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Constraint\Count;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Client $client)
    {
        // $list = Client::with('product')
        // ->orderBy('po_number','desc')
        // ->get(); 
          //  dd($list);        
    
        // return view('backend.client.index', [
        // 'list' => $list
       
        // ]);
        return view('backend.client.index', [
            'list' => $client->getAllClientsWithProducts()
           ]);
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
    public function store(StoreClientRequest $request)
    {   

      // dd($request->products[0]["'name'"]);
        $formNo = config('constants.options.Form_No');
        $clientsCount = DB::table('clients')->count();

        if($clientsCount > 0) {

           $clientLast =Client::orderBy('po_number', 'desc')->first();
            $lastPo = $clientLast->po_number; 
            $poNumberNext =$lastPo +1;

        }
        else {

            $poNumberNext = config('constants.options.Form_No');
        }


        $input =$request->all();
       $file = $request->file('productImage');
   
        $ids = $request->productName;
        $validated = $request->validated();
        if($request->has('id_card_image')) {

            $originalImage= $request->file('id_card_image');
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path().'/idcard/';
            $thumbnailImage->resize(400,200);
            $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());
            $realPath =time().$originalImage->getClientOriginalName();

            }

            else {

                $realPath ='';
            }
     
            if($request->payment_method=='direct'){
            
                $payment_name = $request->payment_full_name;
                $payment_email =$request->payment_email;
                $payment_direct_phone_number =$request->payment_direct_phone_number;
                $payment_direct_account_number =$request->payment_direct_account_number;
                $payment_direct_routing_number =$request->payment_direct_routing_number;
                $payment_direct_account_type =$request->payment_direct_account_type;
                $payment_direct_bank_name =$request->payment_direct_bank_name;
                
            }
            if($request->payment_method=='paypal')
            {
                $payment_name =$request->payment_name_paypal;
                $payment_email =$request->payment_email_paypal;   
            }
            if($request->payment_method=='cheque')
            {
                $payment_name =$request->payment_full_name_cheque;
                $payment_email =$request->payment_email_cheque;

            }
            if($request->payment_method=='echeck')
            {
                $payment_name =$request->payment_full_name_echeck;
                $payment_email =$request->payment_email_echeck;

            }

        $folderPath = public_path('signature/');
	    $imageParts = explode(";base64,", $request->signature64);
	    $imageTypeAux = explode("image/", $imageParts[0]);
	    $imageType = $imageTypeAux[1];
	    $imageBase64 = base64_decode($imageParts[1]);
        $imageName = 'signature'.'_'.microtime().'.'.$imageType;
        $file = $folderPath . $imageName;
	    file_put_contents($file, $imageBase64);

      
         $client = new Client();

        $client->name =$request->input('name');
        $client->email =$request->input('email');
        $client->phone =$request->input('phone');
        $client->address =$request->input('address');
        $client->id_card_image =$realPath;
        $client->payment_method =$request->input('payment_method');
        $client->payment_full_name =$payment_name;
        $client->payment_email =$payment_email;
        $client->payment_direct_phone_number =$payment_direct_phone_number ?? null;
        $client->payment_direct_account_number =$payment_direct_account_number ?? null;
        $client->payment_direct_routing_number =$payment_direct_routing_number ?? null;
        $client->payment_direct_account_type =$payment_direct_account_type ?? null;
        $client->payment_direct_bank_name =$payment_direct_bank_name ?? null;    
        $client->client_status='Pending';
        $client->total_amount = $request->input('grand_total');
        $client->signature =$imageName;
        $client->disclaimer =1;
        $client->po_number =$poNumberNext;

        $client->save();

        $lastId = $client->id;
        $newPo =$client->po_number;
        $condition = $request->productImage;
    
        $products = $request->products;
          
                foreach($products as  $product)
                {
                  
                     if((!empty($product["'image'"]))) {

                       $images = $product["'image'"];
                       
                        $originalImage= $images;

                        $thumbnailImage = Image::make($originalImage);
                        $thumbnailPath = public_path().'/products/';
                        // $originalPath = public_path().'/images/';
                        //$thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
                        $thumbnailImage->resize(200, 200);
                        $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());
                       // $realPath =time().$originalImage->getClientOriginalName();

                        $realPath =time().$originalImage->getClientOriginalName();

                       // dd($realPath);
                    }
                    else {
                        $realPath='';

                    }
                
                               $productNew = new Product();
                                       
                                   $productNew->name = $product["'name'"] ?? '';;
                                   $productNew->condition = $product["'condition'"] ?? '';
                                   $productNew->price = $product["'price'"];
                                   $productNew->client_id =$lastId;
                                   $productNew->image_path = $realPath ?? '';
                                   
                                   $productNew->save();
                             
         
                }

        

      

       
   
               
          
           $clientDetails = Client::with('product')->find($lastId);

           //dd($clientDetails);

           //Gul the below method was not sending email in cc so swiched to below
           //foreach method to send emails

        //    Mail::to($request->input('email')
        //    ->cc(['gulmuhammad57@yahoo.com'])  
        //    )->send(new ThankYou($clientDetails));

        //Gul here sending emails in this way was taking time 
        //so we I used Queue mathod to send emails which is below 
        //   foreach ([$request->input('email'), 'gulmuhammad57@yahoo.com'] as $recipient) {

        //    Mail::to($recipient)->send(new ThankYou($clientDetails));

         


        //     }

       
            
         //This method is used to dispatch emails Gul here
            SendPoEmail::dispatch($clientDetails);
           return redirect()->route('sellyourbags.thankyou', ['id' => $lastId,'po' => $newPo]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id,Client $client)
    {
        // $clientDetails = Client::with('product')->find($id);

        $clientDetails =$client->getClientDetailsById($id);

        return view('backend/client/view',['clientDetails' =>$clientDetails]);
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
      
          $client = Client::where('id',$request->edit_product_id)->first();

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
        //dd($request->edit_product_id_value);
        $this->validate($request, [
            'productPrice_value' => 'required',
            'productImage_value' => 'sometimes|nullable|image|mimes:jpg,jpeg,png',
        ]);

       // dd($request->all());

        DB::beginTransaction();
        try {

          $product = Product::where('id',$request->edit_product_id_value)->first();

          
          $client = Client::where('id',$request->client_id_value)->first();

            if($request->hasFile('productImage_value')) {
               
                $originalImage= $request->file('productImage_value');
                $thumbnailImage = Image::make($originalImage);
                $thumbnailPath = public_path().'/products/';
                // $originalPath = public_path().'/images/';
                //$thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
                $thumbnailImage->resize(200, 200);
                $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());
                $realPath =time().$originalImage->getClientOriginalName();

                
            }
            Product::where('id', $product->id)->update([
  
                'condition' => $request->productCondition ?? null,
                'price' => $request->productPrice_value,
                'name' => $request->productName ?? null,
                'image_path' => $realPath ?? $request->product_image_value
            ]);

            $productAll =Product::all()->where('client_id','=',$request->client_id_value);
        // dd($productAll);
          $sum =0;
        foreach($productAll as $calProduct)
        {

          $sum+= $calProduct['price'];

        }
        //dd($sum);
          
        //   Client::where('id', $client->id)->update([
  
        //       'total_amount' => $request->newTotal ?? $request->total_amount_value
        //   ]);
        Client::where('id', $client->id)->update([
  
            'total_amount' => $sum,
        ]);

        

        

            DB::commit();

            return redirect()->back()->with('productUpdated', __('Product Updated Successfully'));
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->back()->with('danger', __('Something went Wrong'));
        }
    }

    public function editClient($id)
        {

            $clientDetails = Client::with('product')->find($id);

            return view('backend/client/edit',['clientDetails' =>$clientDetails]);


            
        }
    
    /**
     * Update a  resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @return \Illuminate\Http\Response
     */    

    public function update(UpdateClientRequest $request, $id)
    {
      
       // dd($request->signature64);
         DB::beginTransaction();
         try {
 
           $client = Client::where('id',$request->id)->first();
 
           if($request->has('id_card_image')) {
   
            $originalImage= $request->file('id_card_image');
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path().'/idcard/';
           // $originalPath = public_path().'/images/';
            //$thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
            $thumbnailImage->resize(400,200);
            $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());
            $realPath =time().$originalImage->getClientOriginalName();
               
            Client::where('id', $client->id)->update([
                'id_card_image' => $realPath,  
            ]);


        }

            if ($request->filled('signature64')) {
              // dd('yes');
                $folderPath = public_path('signature/');
                $imageParts = explode(";base64,", $request->signature64);
                $imageTypeAux = explode("image/", $imageParts[0]);
                $imageType = $imageTypeAux[1];
                $imageBase64 = base64_decode($imageParts[1]);
                $imageName = 'signature'.'_'.microtime().'.'.$imageType;
                $file = $folderPath . $imageName;
                file_put_contents($file, $imageBase64);
            }
          //  dd('no');
          //  dd($request->oldsignature);
 
           Client::where('id', $client->id)->update([
   
               'name' => $request->name,
               'email' => $request->email,
               'phone' => $request->phone,
               'address' => $request->address,
               'payment_method' => $request->payment_method,
               'payment_full_name' => $request->payment_full_name,
               'payment_email' => $request->payment_email,
               'payment_direct_phone_number' =>$request->payment_direct_phone_number ?? null,
               'payment_direct_account_number' =>$request->payment_direct_account_number ?? null,
               'payment_direct_routing_number' =>$request->payment_direct_routing_number ?? null,
               'payment_direct_account_type' =>$request->payment_direct_account_type ?? null,
               'payment_direct_bank_name' =>$request->payment_direct_bank_name ?? null,  
               'signature' =>$imageName ?? $request->oldsignature,
           ]);
 
             DB::commit();
 
             return redirect()->back()->with('clientdetailsupdated', __('Client Details Updated Successfully'));
         } catch (\Exception $e) {
            dd($e);
 
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

           return view('frontend/pages/thankyou',['id'=> $id]);
    }

    public function print($id)
     {
        $clientDetails = Client::with('product')->find($id);
        return view('frontend/pages/thankyouprint',['clientDetails' =>$clientDetails]);

    }
}
