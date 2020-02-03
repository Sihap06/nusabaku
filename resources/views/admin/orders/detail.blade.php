@extends('layouts/index2')

@section('container')

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="{{asset('storage/'. $order->bukti_tf)}}" class="image-popup"><img src="{{asset('storage/'. $order->bukti_tf)}}" class="img-fluid" width="100%" alt="Colorlib Template"></a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">

                @php
                $items = json_decode($order->items);
                $qty = json_decode($order->qty)
                @endphp
                {{-- @dd($qty) --}}
                @foreach ($qty as $jumlah)
                @endforeach
                @foreach ($items as $data)
                <h3 class="text-capitalize">{{\DB::table('products')->where('slug', $data)->value('product_name')}} <span>[{{$jumlah}}]</span></h3>
                @endforeach
                <p class="price"><span>Rp {{number_format($order->subtotal + $order->cost)}}</span> Total Biaya</p>
                <p></p>
                <div class="row mt-4">
                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <h5 style="color: #000;">Data Order</h5>
                        <p class="text-capitalize">Nama Lengkap : <span>{{$order->nama_depan}} {{$order->nama_belakang}}</span></p>
                        <p class="text-capitalize">Nomor Telepon : <span>{{$order->telepon}}</span></p>
                        <p>Email : <span>{{$order->email}}</span></p>
                        <p>Provinsi: <span>{{\DB::table('provinces')->where('id', $order->provinsi)->value('title')}}</span></p>
                        <p>Kota: <span>{{\DB::table('cities')->where('id', $order->kota)->value('title')}}</span></p>
                        <p>Detail Alamat : <span>{{$order->alamat}}</span></p>
                        <p>Kurir : <span>{{\DB::table('couriers')->where('code', $order->kurir)->value('title')}}</span></p>
                        <p>Kurir : <span>Rp. {{number_format($order->cost)}}</span></p>
                        <p>Status : <span class="badge badge-info">{{$order->status}}</span></p>
                        {{-- @dd($order) --}}
                    </div>
                </div>
                <p class="mt-4">
                    <a href="{{url('kembali')}}" class="btn btn-primary">Kembali</a>
                    <a href="{{url('verifikasiOrder', $order->id)}}" class="btn btn-info">Verifikasi</a>
                    <a href="#" data-toggle="modal" data-id="{{$order->id}}" data-target="#batalModal" class="btn btn-danger">Batal</a>
                </p>
            </div>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="batalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Batal Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ url('batalOrder') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <input type="text" name="alasan" placeholder="masukkan alasan pembatalan order" class="form-control" id="alasan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
@section('section-footer')
<script>
    $('#batalModal').on('show.bs.modal', function(event){
        var button = $(event.relatedTarget)
        var id = button.data('id')

        var modal = $(this)
        modal.find('.modal-body #id').val(id)
    });
</script>
@endsection
