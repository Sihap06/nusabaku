<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd($code);
        return view('cart');
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
    {
        $qtyDB = DB::table('products')->where('id', $request->id)->value('stock');
        $qty = intval($request->qty);
        // dd($qty);
        if ($qtyDB >= $qty) {

            Cart::add($request->id, $request->name, $qty, $request->price)->associate('App\Product');

            return redirect()->route('cart.index')->with('success', 'Produk berhasil dimasukkan di keranjang');
        }elseif ($qtyDB == 0) {
            return back()->with('warning', 'Stock produk kosong');
        }elseif ($qtyDB < $qty) {
            return back()->with('warning', 'Stock produk tidak mencukupi');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // \DB::table('temp_order')->where('id', $id)->where('user_id', Auth::user()->id)->delete();
        // return redirect('/orders');
        Cart::remove($id);

        return redirect('/cart')->with('success', 'Produk telah di hapus dari keranjang');
    }
}
