@extends('layouts/index1')

@section('title', 'Checkout')

@section('container')

@php
$data = \DB::table('temp_order')->where('user_id', Auth::user()->id)->get();
foreach ($data as $item) {
    # code...
}
// dd(json_decode($item->items));
@endphp

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-left">
            <div class="col-xl-7 ftco-animate">
                <form action="{{url('biaya/'. Auth::user()->id)}}" class="billing-form" method="POST">
                    <div class="billing-form">
                        <h3 class="mb-4 billing-heading">Data Pemesanan </h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Nama Depan</label>
                                    <input disabled value="{{$item->nama_depan}}" name="nama_depan" type="text" class="form-control is-valid @error('nama_depan') is-invalid @enderror" placeholder="">
                                    @error('nama_depan') <div class="invalid-feedback">{{$message}}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Nama Belakang</label>
                                    <input disabled value="{{$item->nama_belakang}}" name="nama_belakang" type="text" class="form-control @error('nama_belakang') is-invalid @enderror" placeholder="">
                                    @error('nama_belakang') <div class="invalid-feedback">{{$message}}</div> @enderror
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">No Telepon</label>
                                    <input disabled value="{{$item->telepon}}" name="telepon" type="text" class="form-control @error('telepon') is-invalid @enderror" placeholder="">
                                    @error('telepon') <div class="invalid-feedback">{{$message}}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailaddress">Alamat Email</label>
                                    <input disabled value="{{$item->email}}" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="">
                                    @error('email') <div class="invalid-feedback">{{$message}}</div> @enderror
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="country">Provinsi</label>
                                    @php
                                    $provinces = \DB::table('provinces')->where('province_id', $item->provinsi)->get();

                                    $cities = \DB::table('cities')->where('city_id', $item->kota)->get();
                                    foreach ($provinces as $province) {
                                        # code...
                                    }
                                    foreach ($cities as $city) {

                                    }

                                    @endphp
                                    <input disabled value="{{$province->title}}" name="province_destination" type="text" class="form-control @error('provinsi') is-invalid @enderror" placeholder="">
                                    @error('provinsi') <div class="invalid-feedback">{{$message}}</div> @enderror
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="streetaddress">Detail Alamat</label>
                                    <input disabled value="{{$item->alamat}}" name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" placeholder="House number and street name">
                                    @error('alamat') <div class="invalid-feedback">{{$message}}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Kota</label>
                                    <input disabled value="{{$city->title}}" name="city_destination" type="text" class="form-control @error('kota') is-invalid @enderror" placeholder="">
                                    @error('kota') <div class="invalid-feedback">{{$message}}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postcodezip">Kode Pos</label>
                                    <input disabled value="{{$item->kode_pos}}" name="pos" type="text" class="form-control @error('pos') is-invalid @enderror" placeholder="">
                                    @error('pos') <div class="invalid-feedback">{{$message}}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Kurir</label>
                                    <input disabled value="{{$item->kurir}}" name="courier" type="text" class="form-control text-capitalize @error('courier') is-invalid @enderror" placeholder="">
                                    @error('courier') <div class="invalid-feedback">{{$message}}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xl-5 mt-5 billing-form">
                    <div class="row mt-5 pt-3">
                        <div class="col-md-12">
                            <div class="cart-detail cart-total p-3 p-md-4">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        @csrf
                                        <label for="country">Biaya Pengiriman</label>
                                        <div class="select-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="cost" id="courier" class="form-control @error('courier') is-invalid @enderror">
                                                <option value="">--Pilih Biaya Pengiriman--</option>
                                                @foreach ($cost as $item)
                                                @foreach ($item['costs'] as $data)
                                                @foreach ($data['cost'] as $dta)
                                                <option value="{{$dta['value']}}">{{$data['service'].'-'.'Rp.'.' '. number_format($dta['value'])}}</option>
                                                @endforeach
                                                @endforeach
                                                @endforeach
                                            </select>
                                            {{-- @dd() --}}
                                            @error('courier') <div class="invalid-feedback">{{$message}}</div> @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Bayar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- .col-md-8 -->
            </div>
        </div><!-- END -->
    </form>
</section> <!-- .section -->


@endsection

@section('section-footer')
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
</script>
@stop
