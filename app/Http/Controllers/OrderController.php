<?php

namespace App\Http\Controllers;

use App\Order;
use App\Orderperamalan;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function peramalanproduk()
    {
        $data = Product::all();
        return view('admin.peramalan_produk', compact('data'));
    }

    public function peramalan($slug)
    {
        $data = Product::where('slug', $slug)->get()->all();


        $month = Carbon::now()->subMonth(2);
        $month1 = Carbon::now()->subMonth(1);
        $month2 = Carbon::now();
        $month3 = Carbon::now()->addMonthNoOverflow(1);


        $order = Orderperamalan::where('items', $slug)->whereMonth('created_at', $month)->get()->all();
        $order1 = Orderperamalan::where('items', $slug)->whereMonth('created_at', $month1)->get()->all();
        $order2 = Orderperamalan::where('items', $slug)->whereMonth('created_at', $month2)->get()->all();
        // dd($order1);
        $count = null;
        foreach ($order as $item) {

            $count = $count + $item->qty;
        }

        $count1 = null;
        foreach ($order1 as $item) {

            $count1 = $count1 + $item->qty;

        }


        $count2 = null;
        foreach ($order2 as $item) {

            $count2 = $count2 + $item->qty;
        }
        // dd($count2);




        $wma = (($count2 * 3) + ($count1 * 2) + ($count * 1)) / (6);
        // dd($count * 3);
        // dd($wma);
        // echo $count3;

        return view('admin.peramalan', compact(['wma', 'count', 'count1', 'count2', 'data', 'month', 'month1', 'month2', 'month3']));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = \App\Order::with('user')->with('products')->get();

        // dd($orders);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { }

    public function simpan(Request $request, $id)
    {
        $data_product       = \App\Product::findOrFail($id);
        $data               = new \App\Order;

        $data->product_id   = $data_product->id;
        $data->user_id      = \Auth::user()->id;
        $data->quantity     = $request->get('quantity');
        $data->status       = "SUBMIT";
        $data->save();

        DB::table('order_product')->insert([
            'order_id'      => $data->id,
            'product_id'    => $data_product->id
        ]);


        // var_dump($data);
        return redirect('/belanja')->with('status', 'Produk menunggu konfirmasi');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        // $order = \App\Order::with('user')->with('products')->find($order->id);
        // // dd($orders);
        // return view('admin.orders.show', compact('order'));
    }

    public function detail($id)
    {
        $order = \App\Order::with('products')->findOrFail($id);
        // dd($order);
        return view('admin.orders.detail', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        Order::where('id', $order->id)->update([
            'status' => $request->status
        ]);

        return redirect("/orders")->with('success', 'Order status berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        Order::destroy($order->id);
        return redirect('/orders')->with('success', 'Order successfully deleted');
    }

    public function cekPembayaran($id)
    {
        $data = Order::where(['user_id' => $id, 'status' => 'order'])->get()->all();

        return view('cek_pembayaran', compact('data'));
    }

    public function pembayaranId($id)
    {
        $item = Order::findOrFail($id);
        // dd($item);

        return view('pembayaranId', compact('item'));
    }

    public function verifikasiOrder(Request $request, $id)
    {
        $data = Order::findOrFail($id);
        // dd($data);
        $data->status = 'verifikasi';
        $data->save();

        return back();
    }

    public function batalOrder(Request $request)
    {
        // dd($request->all());
        $data = Order::findOrFail($request->id);
        $data->alasan = $request->alasan;
        $data->status = 'batal';
        $data->save();

        return back();
    }
}
