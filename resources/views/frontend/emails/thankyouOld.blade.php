<style>
    /* @import url('https://fonts.googleapis.com/css?family=Varela+Round'); */

    * {
        margin: 0;
        padding: 0;
        font-family: Metropolis, Arial, sans-serif !important;
    }

    img {
        display: inline-block;
    }

    .container {
        max-width: 600px;
        margin: 20px auto;
        border-radius: 4px;
        border: 1px solid rgba(0, 0, 0, .1);
        /* // border-top: 3px solid #016FB9; */
        min-height: 100px;
        position: relative;

        &::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, #0267C1, #D65108);
        }
    }

    .logo {
        display: flex;
        margin: 30px auto 0;
        align-items: center;
        justify-content: center;

        /* // padding: 20px; */
        a {
            display: block;
            width: 30px;
            height: 30px;
            /* // overflow: hidden; */
        }

        img {
            width: 180px;
        }

        .c-name {
            display: inline-block;
            font-weight: 600;
        }
    }

    .thumbs {
        width: 100px;
        margin: auto;
        height: 136px;

        img {
            width: 100%;
        }
    }

    .illustration {
        width: 100%;
        text-align: center;
        box-shadow: 0 10px 20px -5px rgba(0, 0, 0, .05);
        border-radius: 0 0 50% 50% / 1%;
        text-align: center;
    }

    .illustration img {
        width: 70%;
        margin: 50px auto;
    }

    .separator {
        display: block;
        height: 3px;
        width: 70%;
        margin: 10px auto;
        background-color: rgba(0, 0, 0, .05);
        border-radius: 10px;
        position: relative;
        overflow: hidden;

        &::before,
        &::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 33%;
            border-radius: inherit;
            opacity: .05;
        }

        &::before {
            left: 0;
            background: #EFA00B;
        }

        &::after {
            left: initial;
            right: 0;
            background: #D65108;
        }
    }

    .hgroup {
        text-align: center;
        padding: 50px 30px 30px;
    }

    .name {
        display: block;
        /* // text-transform: uppercase;
        // margin-bottom: 5px; */
        color: #0267C1;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .hgroup h1 {
        font-size: 20px;
        font-weight: 600;
        color: #333;
    }

    .hgroup h2 {
        font-size: 19px;
    }

    .hgroup p {
        font-size: 15px;
        color: slategrey;
        margin-top: 15px;
        text-align: justify;
        line-height: 25px;
    }

    .items {
        padding: 30px;
        padding-bottom: 10px !important;
        display: flex;
        grid-template-columns: repeat(2, 1fr);
    }

    .item {
        margin-bottom: 10px;
        text-align: left;
        width: 300px;
        margin: 0 auto 10px;
    }


    .item .icon {
        margin-bottom: 10px;
    }

    .item .icon img {
        width: 60px;
    }

    .item .title {
        margin-bottom: 5px;
        font-size: 16px;
        font-weight: 600;
    }

    .item .subtitle {
        font-size: 13px;
        color: slategrey;
        padding: 1rem;
    }

    .button-wrap {
        text-align: left;
        padding: 2rem;
    }
</style>
<div class="container"
    style=" max-width: 600px;
margin: 20px auto;
border-radius: 4px;
border: 1px solid rgba(0, 0, 0, .1);
min-height: 100px;
position: relative;font-family: Metropolis, Arial, sans-serif !important;">
    <p style="padding: 30px;
    padding-bottom:0;font-family: Metropolis, Arial, sans-serif !important;color: black;">Hi
    </p>
    <p style="padding: 30px;
    padding-top: 1px;font-family: Metropolis, Arial, sans-serif !important;color: black;">
        Please find purchase order details below. Thank you!</p>


</div>
<div class="container"
    style=" max-width: 600px;
margin: 20px auto;
border-radius: 4px;
border: 1px solid rgba(0, 0, 0, .1);
min-height: 100px;
position: relative;font-family: Metropolis, Arial, sans-serif !important;">
    <div class="items"
        style=" padding: 30px;
    padding-bottom: 0px !important;
    display: flex;
    grid-template-columns: repeat(2, 1fr);padding-right: 0;">
        <div class="item"
            style="margin-bottom: 10px;
        text-align: left;
        width: 300px;
        margin: 0 auto 10px;">

            <div class="title"
                style=" margin-bottom: 5px;
            font-size: 16px;
            font-weight: 600;color: black;">
                Sell Your Bags</div>
            <div class="subtitle" style=" font-size: 13px;
            color: slategrey;
           ">
                3333 Preston Rd Suite 105
            </div>
            <div class="subtitle" style=" font-size: 13px;
            color: slategrey;
           ">
                Frisco, TX 75034 US
            </div>
            <div class="subtitle" style=" font-size: 13px;
            color: slategrey;
            ">
                (214) 444-8048
            </div>
            <div class="subtitle"
                style=" font-size: 13px;
            color: slategrey;
            text-decoration: none !important;margin: 0;
           ">
                <p style="text-decoration: none !important;margin: 0;color:black;">www.sellyourbags.com</p>
            </div>
        </div>
        <div class="item"
            style="padding-right: 45px; margin-bottom: 10px;
        text-align: right;
        width: 300px;
        margin: 0 auto 10px;">
            <div class="icon">
                <img src="{{ $message->embed('app-assets/images/logo/final-logo.png') }}" style="width:180px"
                    alt="Sell Your Bags" border="0">
            </div>

        </div>
    </div>
    <div class="title"
        style="color: #1E7062;font-weight:bold;font-size:24px;padding-top:0px;padding-bottom:4px;padding-left:30px;
         margin-bottom: 5px;
      ">
        PURCHASE ORDER</div>
    {{-- <div class="heading" style="color:black;font-weight:bold;font-size:15px;padding-left:30px;padding-top:5px;">
        SELLER
    </div> --}}
    <div class="items"
        style="padding: 30px;
        padding-bottom: 10px!important;
        display: flex;
        padding-top: 5px;
        padding-right: 0;">

        <div class="item"
            style="margin-bottom: 10px;
        text-align: left;
        width: 300px;
        margin: 0 auto 10px;">
            <div class="subtitle" style=" font-size: 13px;
            color: slategrey;
            ">
                {{ $clientDetails1->name }}
            </div>
            <div class="subtitle" style=" font-size: 13px;
            color: slategrey;
            ">
                {{ $clientDetails1->address }}
            </div>

        </div>
        <div class="item"
            style="padding-left: 56px;
            text-align: left;
            width: 300px;
            margin: 0 auto 10px;
            color: black;">

            <div class="title"
                style=" margin-bottom: 5px;
            font-size: 16px;
            font-weight: 600;color:black">
                PO # {{ $clientDetails1->po_number }}</div>
            <div class="subtitle" style=" font-size: 13px;
            color: slategrey;
            ">
                DATE: {{ $clientDetails1->created_at->format('d-m-Y') }}
            </div>

        </div>
    </div>
    <div class="button-wrap">
        <div class="table-responsive mt-2">
            <div style="background-color: #1E7062;">
                <h5
                    style="font-weight: bold;
                font-size: 15px !important;
                letter-spacing: 0.5px;color:#fff;padding-top:5px;padding-bottom:5px;padding-left:30px;">
                    PRODUCT INFORMATION</h5>
            </div>
            <table style="padding-left: 30px;width:100%;">
                <thead>
                    <tr style="text-align:left;">
                        <th style="">
                            Item Image
                        </th>
                        <th style="">Description
                        </th>
                        <th style="">Conditon
                        </th>
                        <th style="">Price
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientDetails1->product as $item)
                        <tr style="text-align:left;">
                            {{-- <td>{{ $loop->iteration }}</td> --}}
                            <td>
                                {{-- <span class="fw-bold">{{ $item->image_path }}</span> --}}
                                @if ($item->image_path)
                                    <img src="{{ $message->embed('product/' . $item->image_path) }}" width="40px"
                                        height="60px" />
                                @else
                                    <span style="font-weight: bold;"> No Image found</span>
                                @endif
                            </td>
                            <td style="">
                                <span style="font-weight: bold;">{{ $item->name }}</span>
                            </td>
                            <td style="">
                                <span style="font-weight: bold;">{{ $item->condition }}</span>
                            </td>
                            <td style="">
                                <span style="font-weight: bold;">${{ $item->price }}</span>
                            </td>

                        </tr>
                    @endforeach


                </tbody>

            </table>
            {{-- <div style="text-align:right;float: right;padding-right:5px;">
                <h5
                    style="font-weight: bold;background-color: #1E7062;
        font-size: 15px !important;
        letter-spacing: 0.5px;color:#fff;padding-top:5px;padding-bottom:5px;">
                    TOTAL: ${{ $clientDetails1->total_amount }}</h5>
            </div> --}}
        </div>

        {{-- <div style="text-align:right;float: right;padding-right:5px;">
            <h5
                style="font-weight: bold;background-color: #1E7062;
    font-size: 15px !important;
    letter-spacing: 0.5px;color:#fff;padding-top:5px;padding-bottom:5px;">
                TOTAL: ${{ $clientDetails1->total_amount }}</h5>
        </div> --}}


    </div>
    <div class="items"
        style="border-top: 1px solid;
        padding-right: 0px;
        padding-bottom: 10px!important;
        display: flex;">
        <div class="item"
            style="text-align: left;
            width: 300px;
            margin: 0 auto 10px;
            float: left;">
        </div>

        <div class="item"
            style="padding-left: 10px;
            float: right;
            padding-right: 0px;
            text-align: center;
            width: 174px;
            margin: 0 auto 10px;
            margin-left: 115px;
        ">

            <div class="subtitle" style="text-align:right;font-weight:bold;padding-top:2px;
            ">
                <h5
                    style="font-weight: bold;background-color: #1E7062;
    font-size: 15px !important;
    letter-spacing: 0.5px;color:#fff;padding-left:7px;padding-top:7px;padding-bottom:7px;padding-right:30px;text-align:right">
                    TOTAL: ${{ $clientDetails1->total_amount }}</h5>
            </div>

        </div>
    </div>

    <div class="items"
        style=" padding: 30px;
    padding-bottom: 10px !important;
    display: flex;
    grid-template-columns: repeat(2, 1fr);">
        <div class="item"
            style="margin-bottom: 10px;
        text-align: left;
        width: 300px;
        margin: 0 auto 10px;">

            <div class="title"
                style=" margin-bottom: 5px;
            font-size: 16px;
            font-weight: 600;color:black;">
                Disclaimer</div>
            <div class="subtitle" style=" font-size: 13px;
            color: slategrey;
            ">
                <p style="text-align: justify;">
                    The Seller named above undersigns and acknowledges that the items sold and listed here are authentic
                    and
                    have been acquired lawfully. Seller agrees to pay the damages if the items sold to Dallas Designer
                    Handbags are not authentic or acquired with any unlawful means. Seller also agrees to pay
                    authentication
                    charges, $150 for Hermes and $100 for all other brands if the item is NOT authentic. Seller is
                    responsible to pick up their items within 30 days or else we dispose of them.</p>
            </div>

        </div>
        <div class="item"
            style="padding-left: 10px; margin-bottom: 10px;
        text-align: left;
        width: 300px;
        margin: 0 auto 10px;">
            <div class="icon" style="padding-top: 10px;text-align:center;padding-top:4px;">
                <img src="{{ $message->embed('signature/' . $clientDetails1->signature) }}" style="width:170px"
                    alt="Sell Your Bags" border="0">
            </div>
            <div class="subtitle"
                style="border-top:1px solid;text-align:center;font-weight:bold;padding-top:2px;color:black;">
                SIGNATURE
            </div>

        </div>
    </div>
    {{-- <footer>
        Brand Name Inc © 2019
        <br>
        Somewhere in earth.
        <br>
        Tel: 00 1 460 5416
    </footer> --}}
</div>
