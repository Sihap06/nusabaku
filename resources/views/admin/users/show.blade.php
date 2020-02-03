@extends('admin.master')

@section('content')

@php
$provinces = \DB::table('provinces')->pluck('title', 'province_id');
@endphp
<div class="container-fluid">
    <h2 class="text-center">Detail {{$user->name}}</h2>
    <div class="row justify-content-center">
        <div class="card align-items-center col-lg-8 mt-5 p-5">
            @if ($user->avatar)
            <img src="{{asset('storage/'. $user->avatar)}}" width="300px" alt="">
            @else
            <img src="{{asset('images/default_avatar.png')}}" width="300px" alt="">
            {{-- <a href="" class="image-popup"><img width="400px" src="images/default_avatar.png" class="img-fluid" alt="Colorlib Template"></a> --}}
            @endif
            <button data-toggle="modal" data-id="{{$user->id}}" data-target="#fotoModal" class="btn btn-outline-success mt-5">Ganti Foto</button>
        </div>
        
        
        <div class="col-lg-8 p-5">
            <div class="card mb-4 py-3 border-left-success">
                <div class="card-body">
                    <b>Nama :</b>
                    {{$user->name}}
                    <br>
                    <b>Email :</b>
                    {{$user->email}}
                    <br>
                    <b>Role :</b>
                    {{implode(', ', $user->roles()->get()->pluck('name')->toArray())}}
                    <br>
                    <b>Address :</b>
                    {{$user->address}}
                    <br>
                    <b>Phone :</b>
                    {{$user->phone}}
                    <br>
                    <b>Status :</b>
                    {{$user->status}}
                    <p><a href="#" data-id="{{$user->id}}" data-name="{{$user->name}}" data-email="{{$user->email}}" data-phone="{{$user->phone}}" data-address="{{$user->address}}" data-toggle="modal" data-target="#dataModal" class="btn btn-outline-success mt-4">Edit Profile</a></p>
                </div>
            </div>
        </div>
        
    </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="fotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ganti Foto Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('gantiFoto') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <img width="100"class="img-circle" id="uploadPreview"/> <br>
                        
                    </div>
                    
                    <div class="form-group">
                        <input type="file" style="border-radius: 5px; font-size: 15px" name="gambar" class="form-control" id="uploadImage" onchange="PreviewImage();" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{url('editProfile')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input value="{{old('name')}}" type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Username">
                        @error('name') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <input value="{{old('email')}}" type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email">
                        @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <div class="select-wrap">
                            <select value="{{old('province_destination')}}" name="province_destination" id="province_destination" class="form-control @error('province_destination') is-invalid @enderror">
                                <option value="">--Provinsi--</option>
                                @foreach ($provinces as $province => $value)
                                <option value="{{$province}}">{{$value}}</option>
                                @endforeach
                            </select>
                            @error('province_destination') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="select-wrap">
                            <select value="{{old('city_destination')}}" name="city_destination" id="city_destination" class="form-control  @error('city_destination') is-invalid @enderror">
                                <option value="">--Kota--</option>
                            </select>
                            @error('city_destination') <div class="invalid-feedback">{{$message}}</div> @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <input value="{{old('address')}}" type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror"  placeholder="Alamat Lengkap">
                        @error('address') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="form-group">
                        <input value="{{old('phone')}}" type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Nomor Telepon">
                        @error('phone') <div class="invalid-feedback">{{$message}}</div> @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer-script')

<script type="text/javascript">
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
        
        oFReader.onload = function(oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>

<script>
    $(document).ready(function(){
        $('select[name="province_destination"]').on('change', function(){
            let provinceId = $(this).val();
            // console.log(provinceId);
            
            if (provinceId) {
                jQuery.ajax({
                    url: "{{url('province')}}"+'/'+provinceId+'/cities',
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="city_destination"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="city_destination"]').append('<option value="'+ key +'">'+ value +'</option> ');
                        });
                    },
                });
            }else {
                $('select[name="city_destination"]').empty();
            }
        });
        
        
        
    });

    $('#fotoModal').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)
        var id = button.data('id')

        var modal = $(this)
        modal.find('.modal-body #id').val(id)
    });
    
    $('#dataModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var id = button.data('id')
        var name = button.data('name')
        var email = button.data('email')
        var phone = button.data('phone')
        var address = button.data('address')
        
        var modal = $(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #name').val(name)
        modal.find('.modal-body #email').val(email)
        modal.find('.modal-body #phone').val(phone)
        modal.find('.modal-body #address').val(address)
    });
</script>


@endsection