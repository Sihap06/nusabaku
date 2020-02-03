@extends('admin.master')

@section('content')

<div class="container">
    <h2 class="text-center">Form Register Admin</h2>
    <div class="row justify-content-left">
        <div class="col-lg-10">
            <div class="p-5">
                <form class="user" action="{{route('dashboard.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="name" class="form-control form-control-user" id="exampleFirstName" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="confirmpasword" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Ulangi Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" class="form-control form-control-user"  placeholder="Alamat Lengkap">
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control form-control-user" placeholder="Nomor Telepon">
                    </div>
                    <div class="form-group">
                        <label for="Status">Roles User</label><br>
                        @foreach ($roles as $role)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="roles[]" id="role" value="{{ $role->id}}">
                            <label class="form-check-label" for="role">{{$role->name}}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" name="avatar" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Avatar</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Daftarkan Akun
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection