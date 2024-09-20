@extends('frontend.layouts.default')
@section('content')

{{-- <form method="POST" action="{{ route('sellyourbags.store') }}" enctype="multipart/form-data"> --}}
{{-- @csrf --}}
<div class="row  bg-white my-5">
   <div class="col-md-12 my-5 px-0  justify-content-center text-center">
      <h2 class="purchase-color fw-bold fs-2"><span class="text-black">PO NUMBER</span><span
            class="purchase-color ps-2">{{ $po }}</span></h2>
      <h4 class="purchase-color  fs-5">Thank you for submitting your request</h4>
      <p class="purchase-color">
         we will review the details of your items.
      </p>
   </div>


</div>

<div class="row d-flex justify-content-center text-center">
   <div class="col-md-3 d-grid">
      <a href="{{ route('sellyourbags.create') }}" class="btn  btn-lg text-white button-bg" type="submit">CREATE
         ANOTHER</a>
   </div>
   <div class="col-md-3 d-grid">
      <a href="{{ route('pos.index') }}" class="btn button  btn-lg text-white button-bg" target="_blank"
         type="submit">ADMIN
         PANEL</a>
   </div>
   <div class="col-md-3 d-grid">
      <form method="post" action="{{ route('print', $id) }}">
         @csrf
         <button class="btn  btn-lg text-white button-bg" type="submit" formtarget="_blank">PRINT PAGE<i
               class="bi bi-printer"></i></button>
      </form>
   </div>
    <div class="col-md-3 d-grid">
      <a href="{{ url('/barcode-print/' . $id) }}" class="btn button  btn-lg text-white button-bg" target="_blank"
        >Barcode <i class="fas fa-barcode nav-icon"></i></a>
   </div>
</div>
@stop