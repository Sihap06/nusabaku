@extends('layouts/index1')

@section('title', 'Checkout')

@section('container')

{{-- @dd() --}}

<div class="hero-wrap hero-bread" style="background-image: url('images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
                <h1 class="mb-0 bread">Checkout</h1>
            </div>
        </div>
    </div>
</div>


<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-lg-12">
                <div class="row mt-5 pt-3">
                    <div class="col-md-4 d-flex mb-5">
                        <div class="cart-detail cart-total p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Cart Total</h3>

                            <p class="d-flex">
                                <span class="text-capitalize">sub total</span>
                                <span>Rp. {{number_format($item->subtotal)}}</span>
                            </p>
                            <p class="d-flex">
                                <span class="text-capitalize">cost</span>
                                <span>Rp. {{number_format($item->cost)}}</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Total</span>
                                <span>Rp. {{number_format($item->subtotal + $item->cost)}}</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cart-detail p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Tarnsfer Rekening Bank</h3>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <span class="badge badge-info">BRI : 1234-56427-1823 (A/N Sihap Baharuddin)</span>
                                    <span class="badge badge-success">Mandiri : 1234-56427-1823 (A/N Sihap Baharuddin)</span>
                                    <span class="badge badge-warning">BNI : 1234-56427-1823 (A/N Sihap Baharuddin)</span>
                                    <span class="badge badge-primary">BCA : 1234-56427-1823 (A/N Sihap Baharuddin)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cart-detail p-3 p-md-4">
                            {{-- @dd($item) --}}
                            <form action="{{url('selesai', $item->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <h3 class="billing-heading mb-4">Bukti Transfer</h3>
                                <div class="form-group">
                                    <img width="200"class="img-responsive mb-3"  id="uploadPreview"/> <br>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="bukti_tf" class="@error('bukti_tf') is-invalid @enderror custom-file-input" id="uploadImage" onchange="PreviewImage();" required>
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                            @error('bukti_tf') <div class="invalid-feedback">{{$message}}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit"class="btn btn-primary btn-sm mt-3 py-3 px-4">upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- .col-md-8 -->
        </div>
    </div>
</section> <!-- .section -->

@endsection

@section('section-footer')
<script>
    $(document).ready(function(){
        $('select[name="province_destination"]').on('change', function(){
            let provinceId = $(this).val();
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
<script type="text/javascript">
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>
@stop
