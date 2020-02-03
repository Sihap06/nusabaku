@extends('admin.master')

@section('content')

<div class="container-fluid">
    {{-- @dd($data); --}}
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Peramalan Permintaan Produk {{$data[0]->product_name}}</h1>
    </div>  
    <!-- Content Row -->
    <div class="row">
        {{-- @dd($data[0]) --}}
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-capitalize text-gray-800">{{date('F', strtotime($month))}}</div>
                            <div class="text font-weight-bold text-success mt-3 text-uppercase mb-1">Total : {{$count}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-capitalize text-gray-800">{{date('F', strtotime($month1))}}</div>
                            <div class="text font-weight-bold text-success mt-3 text-uppercase mb-1">Total : {{$count1}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-capitalize text-gray-800">{{date('F', strtotime($month2))}}</div>
                            <div class="text font-weight-bold text-success mt-3 text-uppercase mb-1">Total : {{$count2}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    <div class="d-sm-flex align-items-center justify-content-center mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-capitalize text-gray-800">Permintaan Bulan {{date('F', strtotime($month3))}}</div>
                            <div class="text font-weight-bold text-success mt-3 text-uppercase mb-1">Total : {{intval($wma)}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    
</div>
<!-- /.container-fluid -->

</div>

@endsection