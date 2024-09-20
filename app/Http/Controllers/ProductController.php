<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Client;
use App\Models\TemporaryProduct;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{




    public function filepondprocess (Request $request)
    {
       if ($request->has('productImage')) {
           $idcard =$request->file('productImage');
           $file_name =$idcard->getClientOriginalName();
           $folder =uniqid('post',true);
           $idcard->storeAs('products/tmp/' .$folder,$file_name);

           

           TemporaryProduct::create([
               'folder' =>$folder,
               'file' => $file_name
           ]);

           return $folder;
       }
       if ($request->has('productImage1')) {
        $idcard =$request->file('productImage1');
        $file_name =$idcard->getClientOriginalName();
        $folder =uniqid('post',true);
        $idcard->storeAs('products/tmp/' .$folder,$file_name);

        

        TemporaryProduct::create([
            'folder' =>$folder,
            'file' => $file_name
        ]);

        return $folder;
    }
    if ($request->has('productImage2')) {
        $idcard =$request->file('productImage2');
        $file_name =$idcard->getClientOriginalName();
        $folder =uniqid('post',true);
        $idcard->storeAs('products/tmp/' .$folder,$file_name);

        

        TemporaryProduct::create([
            'folder' =>$folder,
            'file' => $file_name
        ]);

        return $folder;
    }

       return '';

     //  dd($folder);

    }
    public function filepondDelete(Request $request) {

      // dd('here in del');
       $fileId = request()->getContent();
       $tmp_file = TemporaryProduct::where('folder', $fileId)->first();
       if($tmp_file) {

               // $realPath1=$tmp_file->folder . '/' .$tmp_file->file;
                Storage::deleteDirectory('/products/tmp/' .$tmp_file->folder);
                $tmp_file->delete();
    
          }
     


    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->client_id_value_add);
        $this->validate($request, [
            'productPriceAdd' => 'required',
            'productImageAdd' => 'sometimes|nullable|image|mimes:jpg,jpeg,png',
        ]);


        DB::beginTransaction();
        try {
         
            if($request->hasFile('productImageAdd')) {
             //   dd('here');
             //   $originalImage= $request->file('productImageAdd');
             //   dd($originalImage);
               // $thumbnailImage = Image::make($originalImage);

               // dd($thumbnailImage);


              //  $folderProduct3 =uniqid('product',true);
              ///  dd($folderProduct3);
                //  $product3->storeAs('products/tmp/' .$folderProduct3,$file_name);
                 // $product3->move(public_path('products/tmp/') .$folderProduct3,$file_name);
             //  $thumbnailPath = public_path().'/products/';
               // $thumbnailPath = 'product/'.$token.'/';
                // $originalPath = public_path().'/images/';
                //$thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
                //$thumbnailImage->resize(400, 200);
               // $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());
              //  dd($thumbnailPath.time().$originalImage->getClientOriginalName());
                //$realPath =$token.'/'.time().$originalImage->getClientOriginalName();
                //$realPathnnnn =$thumbnailPath.$originalImage->getClientOriginalName(); 

               // dd(storage_path().'/public/product/');
               
                $originalImage= $request->file('productImageAdd');
                //create uniue id for folder
                $folder1 =uniqid('product',true);

               // dd($folder1);
                
               //make the path of folder although it does not exist
                $folder = 'product/'.$folder1.'/';
               //dd($folder);


                //create the folder at above path 
                if (! File::exists($folder)) {
                    File::makeDirectory($folder, $mode = 0755, true, true);
                }
                 //   dd('hhhh');
             //   $path = public_path().'/product/' . $folder;
               // $newProductPath =File::makeDirectory($path, $mode = 0755, true, true);
               //$newProductPath = Storage::makeDirectory('public/'.$folder);

              // dd($newProductPath);


                $thumbnailImage = Image::make($originalImage);
                $thumbnailPath = $folder;

                //get the name of folder after product/ as the product word is getting saved in db path
                //so removing it and gettiing only folder name which comes after product/
                $whatIWant = substr($thumbnailPath, strpos($thumbnailPath, "/") + 1);    
                // dd($whatIWant);
                // $originalPath = public_path().'/images/';
                //$thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
                $thumbnailImage->resize(400, 200);
                //saving image in newly created folder
                $thumbnailImage->save($folder.$originalImage->getClientOriginalName());
                
                //dd($thumbnailImage->move(public_path('product') .$folder,$originalImage->getClientOriginalName()));
               // $token = strtok($folder, "/"); // Output 
              //  dd($token);  

                 //saving image path only i-e folderName/image.png without product/
                $realPath =$whatIWant.$originalImage->getClientOriginalName();

               // dd($realPath);

                
            }
            //$client = Client::where('id',$request->client_id_value_add)->first();
         $productNew = new Product();
         $productNew->sku = $this->generateSKU();
                                       
         $productNew->name = $request->productNameAdd ?? '';;
         $productNew->condition = $request->productConditionAdd ?? '';
         $productNew->price = $request->productPriceAdd;
         $productNew->client_id =$request->client_id_value_add;
         $productNew->image_path = $realPath ?? '';
         
         $productNew->save();

       $productAll =Product::all()->where('client_id','=',$request->client_id_value_add);
        // dd($productAll);
          $sum =0;
        foreach($productAll as $calProduct)
        {

          $sum+= $calProduct['price'];

        }
          
        Client::where('id', $request->client_id_value_add)->update([
  
            'total_amount' => $sum,
        ]);

            DB::commit();

            return redirect()->back()->with('productAdded', __('Product Added Successfully'));
        } catch (\Exception $e) {

            DB::rollback();

            return redirect()->back()->with('danger', __('Something went Wrong'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request,[
            'product_id' => 'required'
            ]);
   
            $product = Product::find($request->product_id);
           
            $product->delete();
       
             $productAll =Product::all()->where('client_id','=',$request->relevant_client_id_del);
        
          $sum =0;
        foreach($productAll as $calProduct)
        {

          $sum+= $calProduct['price'];

        }
          
        Client::where('id', $request->relevant_client_id_del)->update([
  
            'total_amount' => $sum,
        ]);
        return redirect()->back()->with('productdeleted', __('Product Deleted Successfully'));
    }

    public function generateSKU() {
        $lastProduct = Product::orderBy('created_at', 'desc')->first();
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
}
