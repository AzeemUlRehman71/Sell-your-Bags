<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Mail\ThankYou;
use App\Models\Product;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use DB;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\Mail;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Client::with('product')->get(); 
                    
    
        return view('backend.client.index', [
        'list' => $list
       
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

        $input =$request->all();
       // dd($input);
       //dd($request->file());

       $file = $request->file('productImage');
       //dd($file);
        $ids = $request->productName;
     // dd(count($input['productPrice']));

        //dd($input);
      //  $condition[] = $input['productName'];
      //  dd(count($condition));

     
      // dd('adfadfadf');

    //  dd($request->all());
        $validated = $request->validated();
        //dd($validated);
        // $this->validate($request, [

        //     'name' => 'required'
        // ]);
        
        if($request->has('id_card_image')) {

            $originalImage= $request->file('id_card_image');
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path().'/idcard/';
            $thumbnailImage->resize(200,200);
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

           // dd($payment_name,$payment_email);
           // $invoice = SaleInvoice::where('invoice_no', $data['invoice_no'])->first();

        $folderPath = public_path('signature/');
	    $imageParts = explode(";base64,", $request->signature64);
	    $imageTypeAux = explode("image/", $imageParts[0]);
	    $imageType = $imageTypeAux[1];
	    $imageBase64 = base64_decode($imageParts[1]);
        $imageName = 'signature'.'_'.microtime().'.'.$imageType;
        $file = $folderPath . $imageName;
	    file_put_contents($file, $imageBase64);

      
         $client = new Client();

         //$client->name =$request->safe(['name']);
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

        $client->save();

        $lastId = $client->id;
         //  dd($request->input('image'));
          dd($request->all());
        $condition = $request->productImage;
      // dd($condition);

            if($request->hasFile('productImage')) {

                $condition = $request->productImage;
               // dd($condition);
                foreach($condition as $index => $condition){
         
                   // if ($request->hasFile(['productImage'])) {
                           $images = $request->file('productImage');
       
                               $originalImage= $images[$index];
       
                          
                               $thumbnailImage = Image::make($originalImage);
                               $thumbnailPath = public_path().'/products/';
                           // $originalPath = public_path().'/images/';
                               //$thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
                               $thumbnailImage->resize(200,200);
                               $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());
                               $realPath =time().$originalImage->getClientOriginalName();
       
                               $product = new Product();
                                       
                                   $product->name = $input['productName'][$index];
                                   $product->condition = $input['productCondition'][$index];
                                   $product->price = $input['productPrice'][$index];
                                   $product->client_id =$lastId;
                                   $product->image_path = $realPath;
                                   
                                   $product->save();
                             
                          
                    //    }
       
                    //    else {
       
                    //                $product = new Product();
                                       
                    //                $product->name = $input['productName'][$index];
                    //                $product->condition = $input['productCondition'][$index];
                    //                $product->price = $input['productPrice'][$index];
                    //                $product->client_id =$lastId;
                    //                $product->image_path = null;
                                   
                    //                $product->save();
       
                    //    }
                                    
         
                }

            }

            if( $request->has("productPrice") ) 
            {
                $condition = $request->productPrice;
                dd('else');

                foreach($condition as $index => $condition){
         
                                $product = new Product();
                                        
                                    $product->name = $input['productName'][$index];
                                    $product->condition = $input['productCondition'][$index];
                                    $product->price = $input['productPrice'][$index];
                                    $product->client_id =$lastId;
                                    $product->image_path = null;
                                    
                                    $product->save();
                                                 
                 }


            }

       
   
               
          
           $clientDetails = Client::with('product')->find($lastId);
        //    Mail::to($request->input('email')
        //    ->cc(['gulmuhammad57@yahoo.com'])  
        //    )->send(new ThankYou($clientDetails));

           foreach ([$request->input('email'), 'gulmuhammad57@yahoo.com'] as $recipient) {
            Mail::to($recipient)->send(new ThankYou($clientDetails));
        }
           return redirect()->route('sellyourbags.thankyou', ['id' => $lastId]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clientDetails = Client::with('product')->find($id);

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

          //  $this->Repository->editProductUnit($request->all());
          $client = Client::where('id',$request->edit_product_id)->first();

         // dd($client);

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
      
         // dd($request->all());
         DB::beginTransaction();
         try {
 
           //  $this->Repository->editProductUnit($request->all());
           $client = Client::where('id',$request->id)->first();
 
           if($request->has('id_card_image')) {

               
            $originalImage= $request->file('id_card_image');
            $thumbnailImage = Image::make($originalImage);
            $thumbnailPath = public_path().'/idcard/';
           // $originalPath = public_path().'/images/';
            //$thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
            $thumbnailImage->resize(200,200);
            $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());
            $realPath =time().$originalImage->getClientOriginalName();
               
            Client::where('id', $client->id)->update([
                'id_card_image' => $realPath,  
            ]);


     }
 
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
           ]);
 
             DB::commit();
 
             return redirect()->back()->with('clientdetailsupdated', __('Client Details Updated Successfully'));
         } catch (\Exception $e) {
 
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

        //$client =Client::find($id)->with('products');
       // $client = Client::with('product')->find($id);

      //  $id =$client->id;

        //dd($client->id);

        //return view('frontend/pages/thankyou',['id' =>$id]);
     //   return view('frontend/pages/thankyou',[$id]);
        // return view('frontend/pages/thankyou')
        //     ->with('id', $id);
           // Route::view('/thankyou', 'frontend/pages/thankyou', ['id' =>$id]);
           return view('frontend/pages/thankyou',['id'=> $id]);
    }

    public function print($id)
     {
        $clientDetails = Client::with('product')->find($id);
        //dd($clientDetails);

        return view('frontend/pages/thankyouprint',['clientDetails' =>$clientDetails]);

    }
}
