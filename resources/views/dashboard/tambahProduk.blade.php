@extends('dashboard.layout')

@section('content')

<div class="container">
    <div class="row justify-content-left">
        <div class="col-lg-10">
            <div class="p-5">
                <form class="user">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="email" placeholder="Nama Produk">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="harga-produk" placeholder="Harga Produk">
                    </div>
                    
                    <div class="form-group">
                        <label>Kategori</label>
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" id="customCheck">
                            <label class="custom-control-label" for="customCheck">Tepung</label>
                        </div>
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" id="customCheck">
                            <label class="custom-control-label" for="customCheck">Pangan</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="alamat-mitra" placeholder="Alamat Mitra">
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