@extends('admin.master')

@section('content')

{{-- @dd($orders) --}}
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
                    <form action="{{url('selesai')}}" method="POST">
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
                        <button type="submit" class="btn btn-primary">Verifikasi</button>
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

	$(document).ready(function(){
		$('#dataTable').DataTable({
            "pageLength":5,
            processing:true,
            searching:true,
            order:[[0,'asc']],
            info:false,
            lengthMenu: [[5,10,15,20,-1],[5,10,15,20,"All"]],
            serverside:true,
            ordering:true,
            ajax:"{{route('ajax.get.new_order')}}",
            columns: [
            {data: 'status', name: 'status'},
            {data: 'nama_depan', name: 'nama_depan'},
            {data: 'items', name: 'items'},
            {data: 'qty', name: 'qty'},
            {data: 'total_biaya', name: 'total_biaya'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action'}
            ]

        });
	})

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
