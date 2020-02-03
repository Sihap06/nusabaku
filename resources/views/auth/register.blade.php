<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Daftar</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('fonts/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="row justify-content-center">

    <div class=" col-lg-5 card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
              </div>
              <form class="user" action="{{route('users.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group">
                  <input value="{{old('name')}}" type="text" name="name" class="form-control form-control-user @error('name') is-invalid @enderror" id="exampleFirstName" placeholder="Nama Lengkap">
                  @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
                <div class="form-group">
                  <input value="{{old('email')}}" type="email" name="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail" placeholder="Email">
                  @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password">
                    @error('password') <div class="invalid-feedback">{{$message}}</div> @enderror
                  </div>
                  <div class="col-sm-6">
                    <input type="password" name="confirmpassword" class="form-control form-control-user @error('confirmpassword') is-invalid @enderror" id="exampleRepeatPassword" placeholder="Konfirmasi Password">
                    @error('confirmpassword') <div class="invalid-feedback">{{$message}}</div> @enderror
                  </div>
                </div>
                <div class="form-group">
                  <input value="{{old('address')}}" type="text" name="address" class="form-control form-control-user @error('address') is-invalid @enderror"  placeholder="Alamat Lengkap">
                  @error('address') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
                <div class="form-group">
                  <input value="{{old('phone')}}" type="text" name="phone" class="form-control form-control-user @error('phone') is-invalid @enderror" placeholder="Nomor Telepon">
                  @error('phone') <div class="invalid-feedback">{{$message}}</div> @enderror
                </div>
                <div class="form-group">
                  <div class="custom-file">
                    <input type="file" name="avatar" class="custom-file-input @error('avatar') is-invalid @enderror" id="customFile">
                    <label class="custom-file-label" for="customFile">Avatar</label>
                    @error('avatar') <div class="invalid-feedback">{{$message}}</div> @enderror
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Daftarkan Akun
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Lupa Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="{{url('/login')}}">Sudah Punya Akun? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('js/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

</body>

</html>
