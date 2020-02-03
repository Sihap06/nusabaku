@extends('dashboard.layout')

@section('content')

<div class="container">
    <div class="row justify-content-left">
        <div class="col-lg-10">
            <div class="p-5">
                <form class="user" enctype="multipart/form-data" action="{{route('categories.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="category_name" class="form-control form-control-user" id="email" placeholder="Category Name">
                    </div>
                    <div class="form-group">
                        <input type="file" name="image" class="form-control form-control-user" id="harga-produk" placeholder="Category Image">
                    </div>
                    <Button type="submit" class="btn btn-success btn-user">
                        Submit
                    </Button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection