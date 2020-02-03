@extends('admin.master')

@section('content')

<div class="container-fluid">
    {{-- @dd($orders) --}}
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Order</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Pembeli</th>
                            <th>Produk</th>
                            <th>Total quantity</th>
                            <th>Total biaya</th>
                            <th>Tanggal pesen</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $kampang = $orders->all();
                        @endphp
                        @foreach ($kampang as $order)
                        {{-- @dd($order) --}}

                        <tr>
                            <td>
                                @if ($order->status == 'booked')
                                <span class="badge bg-warning text-light">{{$order->status}}</span>
                                @elseif($order->status == 'order')
                                <span class="badge bg-info text-light">{{$order->status}}</span>
                                @elseif($order->status == 'verifikasi')
                                <span class="badge bg-primary text-light">{{$order->status}}</span>
                                @elseif($order->status == 'batal')
                                <span class="badge bg-danger text-light">{{$order->status}}</span>
                                @elseif($order->status == 'proses')
                                <span class="badge bg-gradient-success text-light">{{$order->status}}</span>
                                @elseif($order->status == 'selesai')
                                <span class="badge bg-gradient-secondary text-light">{{$order->status}}</span>
                                @endif
                            </td>
                            <td>
                                {{$order->nama_depan}}
                                <br>
                                <small>{{$order->email}}</small>
                            </td>
                            <td>
                                @php
                                $items = json_decode($order->items);
                                @endphp
                                @foreach ($items as $item)
                                <span>{{$item}},</span>
                                @endforeach
                            </td>
                            <td>
                                @php
                                $qty = json_decode($order->qty);
                                @endphp
                                @foreach ($qty as $dta)
                                <span>{{$dta}},</span>
                                @endforeach
                            </td>
                            <td>Rp. {{number_format($order->subtotal + 2000)}}</td>
                            <td>{{date('Y-m-d', strtotime($order->created_at))}}</td>
                            <td>
                                {{-- <a href="{{ url('/detail', $order->id)}}"> --}}
                                    <button type="button" data-toggle="modal" data-target=".bd-example-modal-lg" data-id="{{$order->id}}" data-name="{{$order->nama_depan}} {{$order->nama_belakang}}" data-email="{{$order->email}}" data-product="{{$order->items}}" data-qty="{{$order->qty}}" data-biaya="{{number_format($order->subtotal + 2000)}}" data-tanggal="{{date('Y-m-d', strtotime($order->created_at))}}" data-telepon="{{$order->telepon}}"  data-kota="{{DB::table('cities')->where('city_id', $order->kota)->value('title')}}" data-alamat="{{$order->alamat}}" data-status="{{$order->status}}" class="btn btn-info btn-sm">Detail</button>
                                    {{-- </a> --}}
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Edit -->
<div class="modal bd-example-modal-lg fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Detail Order dan Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="{{url("selesai")}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group col-6">
                                <label>Status :</label>
                                <input class="form-control" type="text" id="status" name="status" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Nama :</label>
                                <input class="form-control" type="text" id="name" name="name" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Email :</label>
                                <input class="form-control" type="text" id="email" name="email" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Telepon :</label>
                                <input class="form-control" type="text" id="telepon" name="telepon" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Kota :</label>
                                <input class="form-control" type="text" id="kota" name="kota" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Alamat :</label>
                                <input class="form-control" type="text" id="alamat" name="alamat" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Produk :</label>
                                <input class="form-control" type="text" id="product" name="product" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Total Quantity :</label>
                                <input class="form-control" type="text" id="qty" name="qty" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Total Biaya :</label>
                                <input class="form-control" type="text" id="biaya" name="biaya" readonly>
                            </div>
                            <div class="form-group col-6">
                                <label>Tanggal :</label>
                                <input class="form-control" type="text" id="tanggal" name="tanggal" readonly>
                            </div>
                        </div>
                        <button type="submit" name="action" value="verifikasi" class="btn btn-primary">Verifikasi Order</button>
                        <button type="submit" name="action" value="selesai" class="btn btn-success">Selesai Order</button>
                        <button type="submit" name="action" value="batal" class="btn btn-danger">Batal Order</button>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer-script')

<script>

    $('#detailModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var nama_lengkap = button.data('name')
            var email = button.data('email')
            var product = button.data('product')
            var qty = button.data('qty')
            var biaya = button.data('biaya')
            var tanggal = button.data('tanggal')
            var telepon = button.data('telepon')
            var kota = button.data('kota')
            var alamat = button.data('alamat')
            var status = button.data('status')
            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #name').val(nama_lengkap)
            modal.find('.modal-body #product').val(product)
            modal.find('.modal-body #qty').val(qty)
            modal.find('.modal-body #email').val(email)
            modal.find('.modal-body #telepon').val(telepon)
            modal.find('.modal-body #kota').val(kota)
            modal.find('.modal-body #alamat').val(alamat)
            modal.find('.modal-body #biaya').val(biaya)
            modal.find('.modal-body #tanggal').val(tanggal)
            modal.find('.modal-body #status').val(status)
        });





    </script>

    @endsection
