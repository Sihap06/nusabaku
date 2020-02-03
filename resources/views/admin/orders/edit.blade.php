@extends('admin.master')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="p-5">
                <form class="user" action="/orders/{{$order->id}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    {{method_field('PUT')}}
                    
                    <div class="form-group">
                        <label for="invoice_number">Bukti Transfer</label>
                        @if ($order->bukti_tf != 0)
                        <img src="{{asset('storage/'. $order->bukti_tf)}}" alt="">
                        @else
                            <input disabled type="text" value="Belum mengirim bukti transfer" class="form-control form-control-user">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="Buyer">Buyer</label>
                        <input disabled type="text" value="{{$order->user->name}}" class="form-control form-control-user">
                    </div>
                    <div class="form-group">
                        <label for="created_at">Quantity</label>
                        <input disabled type="text" value="{{$order->quantity}}" class="form-control form-control-user">
                    </div>
                    <div class="form-group">

                        <label for="total_price">Total Price</label>
                        <input disabled type="text" value="{{$order->total_price}}" class="form-control form-control-user">
                    </div>
                    <div class="form-group">
                        <label for="statu">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option {{$order->status == 'SUBMIT' ? 'selected' : ''}} value="SUBMIT">SUBMIT</option>
                            <option {{$order->status == 'PROCESS' ? 'selected' : ''}} value="PROCESS">PROCESS</option>
                            <option {{$order->status == 'FINISH' ? 'selected' : ''}} value="FINISH">FINISH</option>
                            <option {{$order->status == 'CANCEL' ? 'selected' : ''}} value="CANCEL">CANCEL</option>
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="address">Address</label>
                    </div> --}}

                    <Button type="submit" class="btn btn-primary btn-user">
                        Update
                    </Button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection