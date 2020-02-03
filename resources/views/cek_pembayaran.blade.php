@extends('layouts/index1')


@section('container')


<div class="hero-wrap hero-bread" style="background-image: url('https://lunarian-id.com/toko-online/storage/image_banner/light-green-solid-color.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                {{-- <span class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></span> --}}
                <h1 class="mb-0 bread">Pembelian</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-cart">
    <div class="container">
        {{-- <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>Produk</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)

                            <tr class="text-center">
                                <td class="product-remove"><a href="{{url('pembayaran', $item->id)}}"><i class="fas fa-file-invoice"></i></a></td>

                                <td class="product-name">
                                    <p>
                                        @php
                                        $items = json_decode($item->items);
                                        @endphp
                                        @foreach ($items as $product)

                                        {{\DB::table('products')->where('slug', $product)->value('product_name')}},

                                        @endforeach
                                    </p>
                                </td>

                                <td class="price">
                                    @foreach (json_decode($item->qty) as $quantity)

                                    {{$quantity}},

                                    @endforeach
                                </td>

                                <td class="total">
                                    Rp. {{number_format($item->subtotal + $item->cost)}}
                                </td>
                            </tr><!-- END TR-->

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
        <div class="tabcontent" id="pembelian">
            <div class="row justify-content-center">
                <div class="col-md-12 cart-list col-lg-12">
                    <table class="table align-items-center card table-borderless">
                        <thead class="thead-inverse">
                            <tr>
                                <th>
                                    <button  onclick="nextPage('dikonfirmasi', this, '#82ae46', '#000')" id="defaultBuka" class="btn btn-light p-3 tabnext">Menunggu Konfirmasi</button>
                                </th>
                                <th>
                                    <button onclick="nextPage('diproses', this, '#82ae46', '#fff')" class="btn btn-light tabnext p-3">Pesanan Diproses</button>
                                </th>
                                <th>
                                    <button onclick="nextPage('selesai', this, '#82ae46', '#fff')" class="btn btn-light tabnext p-3">Pesanan Selesai</button>
                                </th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td class="">
                                    <div id="dikonfirmasi" class="tabtransaksi align-items-start">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="cart-list">
                                                    <table class="table">
                                                        <thead class="thead-primary">
                                                            <tr class="text-center">
                                                                <th style="width: 25%;">List Produk</th>
                                                                <th style="width: 25%;">Quantity</th>
                                                                <th style="width: 25%;">Total</th>
                                                                <th style="width: 25%;">Tanggl</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $data = \DB::table('orders')->where(['user_id' => Auth::user()->id, 'status' => 'order'])->get()->all();
                                                            // dd($data);
                                                            @endphp
                                                            @foreach ($data as $item)

                                                            <tr class="text-center">
                                                                <td class="product-name text-capitalize">
                                                                    @foreach (json_decode($item->items) as $product)
                                                                    {{\DB::table('products')->where('slug', $product)->value('product_name')}}<br>
                                                                    @endforeach
                                                                </td>

                                                                <td class="quantity">
                                                                    @foreach (json_decode($item->qty) as $qty)
                                                                    {{$qty}}<br>
                                                                    @endforeach
                                                                </td>

                                                                <td class="total">
                                                                    Rp {{number_format($item->subtotal + 3000)}}
                                                                </td>
                                                                <td class="total">
                                                                    {{date('d-m-Y', strtotime($item->created_at))}}
                                                                </td>
                                                            </tr><!-- END TR-->
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="diproses" class="tabtransaksi align-items-start">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="cart-list">
                                                    <table class="table">
                                                        <thead class="thead-primary">
                                                            <tr class="text-center">
                                                                <th style="width: 25%;">List Produk</th>
                                                                <th style="width: 25%;">Quantity</th>
                                                                <th style="width: 25%;">Total</th>
                                                                <th style="width: 25%;">Tanggl</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $data = \DB::table('orders')->where(['user_id' => Auth::user()->id, 'status' => 'proses'])->get()->all();
                                                            // dd($data);
                                                            @endphp
                                                            @foreach ($data as $item)

                                                            <tr class="text-center">
                                                                <td class="product-name text-capitalize">
                                                                    @foreach (json_decode($item->items) as $product)
                                                                    {{\DB::table('products')->where('slug', $product)->value('product_name')}}<br>
                                                                    @endforeach
                                                                </td>

                                                                <td class="quantity">
                                                                    @foreach (json_decode($item->qty) as $qty)
                                                                    {{$qty}}<br>
                                                                    @endforeach
                                                                </td>

                                                                <td class="total">
                                                                    Rp {{number_format($item->subtotal + 3000)}}
                                                                </td>
                                                                <td class="total">
                                                                    {{date('d-m-Y', strtotime($item->created_at))}}
                                                                </td>
                                                            </tr><!-- END TR-->
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="selesai" class="tabtransaksi align-items-start">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="cart-list">
                                                    <table class="table">
                                                        <thead class="thead-primary">
                                                            <tr class="text-center">
                                                                <th style="width: 20%;">List Produk</th>
                                                                <th style="width: 20%;">Quantity</th>
                                                                <th style="width: 20%;">Total</th>
                                                                <th style="width: 20%;">Tanggl</th>
                                                                <th style="width: 20%;">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $items = \DB::table('orders')->where(['user_id' => Auth::user()->id, 'status' => 'selesai'])->get()->all();
                                                            // dd($items);
                                                            @endphp
                                                            @foreach ($items as $item)

                                                            <tr class="text-center">
                                                                <td class="product-name text-capitalize">
                                                                    @foreach (json_decode($item->items) as $product)
                                                                    {{\DB::table('products')->where('slug', $product)->value('product_name')}}<br>
                                                                    @endforeach
                                                                </td>

                                                                <td class="quantity">
                                                                    @foreach (json_decode($item->qty) as $qty)
                                                                    {{$qty}}<br>
                                                                    @endforeach
                                                                </td>

                                                                <td class="total">
                                                                    Rp {{number_format($item->subtotal + 3000)}}
                                                                </td>
                                                                <td class="total">
                                                                    {{date('d-m-Y', strtotime($item->created_at))}}
                                                                </td>
                                                                <td>
                                                                    @php
                                                                    $data =count(\DB::table('testimoni')->where('order_id', $item->id)->get());

                                                                    @endphp
                                                                    @if($data == 0)
                                                                    <a href="#" value={{action('HomeController@testiModal', ['id' => $item->id])}}  data-toggle="modal" data-target="#ratingModal" class="btn btn-primary btn-sm ratingModal">Rating</a>
                                                                    @endif
                                                                </td>
                                                            </tr><!-- END TR-->
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Rate Us</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="modalContent"></div>
            </div>
        </div>
    </div>
</div>


@stop

@section('section-footer')

<script>

    $(document).on('ajaxComplete ready',function () {
        $('.ratingModal').off('click').on('click', function () {
            $('#modalContent').load($(this).attr('value'));
        });

    });



    function nextPage(pageName,elmnt,bgcolor, color) {
        var i, tabtransaksi, tabnext;
        tabtransaksi = document.getElementsByClassName("tabtransaksi");
        for (i = 0; i < tabtransaksi.length; i++) {
            tabtransaksi[i].style.display = "none";
        }
        tabnext = document.getElementsByClassName("tabnext");
        for (i = 0; i < tabnext.length; i++) {
            tabnext[i].style.backgroundColor = "";
        }
        document.getElementById(pageName).style.display = "block";
        elmnt.style.backgroundColor = bgcolor;
        elmnt.style.color = color;
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultBuka").click();
</script>

@endsection
