@extends('admin.master')

@section('content')

<div class="container-fluid">
    {{-- @dd($data); --}}
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Peramalan Penjualan</h1>
    </div>  
    <!-- Content Row -->
    <div class="row">
        @foreach ($data as $item)
        
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-capitalize text-gray-800">{{$item->product_name}}</div>
                            <div class="text-xs font-weight-bold text-success mt-3 text-uppercase mb-1">stock : {{$item->stock}}</div>
                        </div>
                        <div class="col-auto">
                            <a href="{{url('peramalan', $item->slug)}}">
                                <i class="fas fa-angle-right fa-2x text-gray-300"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        
    </div>
    <!-- /.container-fluid -->
    
</div>

</div>

@endsection