@extends('dashboard.layout')

@section('content')

<div class="container">
    <h2 class="text-center">Form Register Admin</h2>
    <div class="row justify-content-left">
        <div class="col-lg-10">
            <div class="p-5">
                <form class="user">
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control form-control-user" id="confirmPassword" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="confirmPassword" placeholder="Role">
                    </div>
                    <div class="form-group">
                            <label for="">Foto</label> <br>
                            <input type="file" id="confirmPassword">
                        </div>
                    <Button type="submit" class="btn btn-primary btn-user">
                        Submit
                    </Button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection