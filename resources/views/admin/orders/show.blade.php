@extends('admin.master')

@section('content')



<div class="container-fluid">
    
    @foreach ($order->products as $data)
    <h2 class="text-center">Detail {{$data->product_name}}</h2>
    <div class="row justify-content-center">
        <div class="col-lg-5 p-5">
            @if ($data->avatar)
            <img src="{{asset('storage/'. $data->avatar)}}" width="400px" class="img-detail" alt="">
            @else
            No Avatar
            @endif
        </div>
        <div class="col-lg-5 p-5">
            <div class="card mb-4 py-3 border-left-success">
                <div class="card-body">
                    <b>Nama Produk :</b>
                    {{$data->product_name}}
                    <br>
                    <b>Harga Produk :</b>
                    {{$data->price}}
                    <br>
                    <b>Deskripsi Produk :</b>
                    {{$data->description}}
                    <br>
                    <b>Jumlah Produk :</b>
                    {{$order->quantity}}
                    <br>
                    <b>Stock Produk :</b>
                    {{$data->stock}}
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection