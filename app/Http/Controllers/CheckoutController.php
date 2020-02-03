<?php

namespace App\Http\Controllers;

use App\City;
use App\Courier;
use App\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $couriers = Courier::pluck('title', 'code');
        $provinces = Province::pluck('title', 'province_id');
        $cities = City::pluck('title', 'province_id', 'city_id');
        // dd($cities);
        return view('checkout', compact(['couriers', 'provinces']));
    }

    public function gettown()
    {
        $town = Province::all();
        return response()->json($town);
    }

    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('title', 'city_id');
        return json_encode($city);
        // dd($city);
    }

    public function getPembayaran(Request $request)
    {
        // dd($request->all());
        \Validator::make($request->all(), [
            "nama_depan"      => "required|min:3|max:100",
            "nama_belakang"   => "required|min:5|max:100",
            "telepon"     => "required|digits_between:10,14",
            "email"     => "required|email",
            "province_destination"  => "required",
            "alamat" => "required|min:10",
            "city_destination"    => "required",
            "mou" => "required"
        ])->validate();

        // $cost = RajaOngkir::ongkosKirim([
        //     'origin'        => $request->city_origin,
        //     'destination'   => $request->city_destination,
        //     'weight'        => $request->weight,
        //     'courier'       => $request->courier
        // ])->get();




        $items = Cart::content()->map(function ($item) {
            return $item->model->slug;
        })->values()->toJson();
        $qty = Cart::content()->map(function ($item) {
            return $item->qty;
        })->values()->toJson();
        // dd($request->province_destination);

        // $cek = count(\DB::table('temp_order')->where('user_id', Auth::user()->id)->get());

        // if ($cek > 0) {
        //     \DB::table('temp_order')->update([
        //         'user_id' => Auth::user()->id,
        //         'nama_depan' => $request->nama_depan,
        //         'nama_belakang' => $request->nama_belakang,
        //         'items' => $items,
        //         'subtotal' => Cart::subtotal(),
        //         'qty' => $qty,
        //         'telepon' => $request->telepon,
        //         'email' => $request->email,
        //         'provinsi' => $request->province_destination,
        //         'kota' => $request->city_destination,
        //         'alamat' => $request->alamat,
        //         'created_at' => Carbon::now(),
        //     ]);
        // } else {

        // }

        \DB::table('orders')->insert([
            'user_id' => Auth::user()->id,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'items' => $items,
            'subtotal' => Cart::subtotal(),
            'qty' => $qty,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'provinsi' => $request->province_destination,
            'kota' => $request->city_destination,
            'alamat' => $request->alamat,
            'created_at' => Carbon::now(),
        ]);


        Cart::instance('default')->destroy();



        // dd($cost);
        return redirect('terimakasih');
    }

    public function costOngkir(Request $request, $id)
    {

        $data = \DB::table('temp_order')->where('user_id', $id)->get();
        $temp_order = $data->all();
        $items = ($temp_order[0]);

        $count = 0;
        foreach (json_decode($items->items) as $item) {

            $x = new \App\Orderperamalan;
            $x->items = $item;
            // var_dump($item);
            // die();
            $kampang = json_decode($items->qty);
            // var_dump($kampang[$count]);
            // die();
            $x->qty = $kampang[$count];
            $x->save();
            $count++;
            // dd($x);
        }




        foreach ($temp_order as $item) {
            \DB::table('orders')->insert([
                'user_id' => $item->user_id,
                'nama_depan' => $item->nama_depan,
                'nama_belakang' => $item->nama_belakang,
                'items' => $item->items,
                'subtotal' => $item->subtotal,
                'qty' => $item->qty,
                'telepon' => $item->telepon,
                'email' => $item->email,
                'provinsi' => $item->provinsi,
                'kota' => $item->kota,
                'alamat' => $item->alamat,
                'kode_pos' => $item->kode_pos,
                'kurir' => $item->kurir,
                'cost' => $request->cost,
                'created_at' => Carbon::now(),
            ]);
        }


        \DB::table('temp_order')->where('user_id', $id)->delete();

        return redirect('/pembayaran');
    }

    public function pembayaran()
    {
        return view('pembayaran');
    }

    public function selesai(Request $request)
    {
        switch ($request->input('action')) {
            case 'verifikasi':
                $items = json_decode(\DB::table('orders')->where('id', $request->get('id'))->value('items'));
                $qty = json_decode(\DB::table('orders')->where('id', $request->get('id'))->value('qty'));
                // dd(json_decode($items));
                foreach ($items as $product) {
                    $stock = \DB::table('products')->where('slug', $product)->value('stock');
                    // dd($stock);
                    foreach ($qty as $jumlah) {
                        \DB::table('products')->where('slug', $product)->update([
                            'stock' => $stock - $jumlah
                        ]);
                        // dd($product);
                    }
                }
                \DB::table('orders')->where('id', $request->get('id'))->update([
                    // 'bukti_tf' => $image_path,
                    'status' => 'proses'
                ]);

                return back();
                break;

            case 'batal':
                \DB::table('orders')->where('id', $request->get('id'))->update([
                    // 'bukti_tf' => $image_path,
                    'status' => 'batal'
                ]);

                return back();
                break;

            case 'selesai':
                \DB::table('orders')->where('id', $request->get('id'))->update([
                    // 'bukti_tf' => $image_path,
                    'status' => 'selesai'
                ]);

                return back();
                break;
        }


    }

    public function terimakasih()
    {
        return view('terimakasih');
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
    { }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
