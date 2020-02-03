<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $order = Order::where('status', 'order')->get()->all();
        $new_order = count($order);
        // dd($new_order);

        return view('admin.index')->with(['user' => User::count(), 'products' => Product::count(), 'orders' => Order::count(), 'new_order' => $new_order ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create')->with(['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new \App\User;

        $adminRole = Role::where('name', 'admin')->first();

        $data->name = $request->get('_name');
        $data->email = $request->get('_email');
        $data->address = $request->get('_address');
        $data->phone = $request->get('_phone');
        $data->password = \Hash::make($request->get('_password'));

        if ($request->hasFile('_avatar')) {
            $dir = 'avatars';
            $path = $request->file('_avatar')->store($dir, 'public');
            $data->avatar = $path;
        }

        $data->save();
        $data->roles()->attach($adminRole);

        return response()->json(['success' => 'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\User::find($id);

        return view('admin.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->id == $id) {
            return redirect()->route('dashboard.index')->with('warning', 'You are not alllowed to edit yourself');
        }

        return view('admin.users.edit')->with(['user' => User::find($id), 'dashboard' => User::all(), 'roles' => Role::all()]);
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
        $user = \App\User::find($id);

        \Validator::make($request->all(), [
            'name'      => 'required|min:5|max:100',
            'email'     => 'required|email',
            'address'   => 'required|min:10|max:200',
            'phone'     => 'required|digits_between:12,13'
        ])->validate();



        $user->roles()->sync($request->roles);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->address = $request->get('address');
        $user->phone = $request->get('phone');
        $new_avatar = $request->file('avatar');
        if ($new_avatar) {
            if ($user->avatar && file_exists(storage_path('app/public/' . $user->avatar))) {
                \Storage::delete('public/' . $user->avatar);
            }

            $new_product_path = $new_avatar->store('images_product', 'public');

            $user->avatar = $new_product_path;
        }

        $user->status = $request->get('status');

        $user->save();

        return redirect()->route('dashboard.edit', ['id' => $id])->with('success', 'User Succesfully updates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (Auth::user()->id == $id) {
            return redirect()->route('dashboard.index')->with('warning', 'You are not alllowed to delete yourself.');
        }

        User::destroy($request->hapus_id);
        Role::destroy($request->hapus_id);
        return redirect()->route('users.index')->with('success', 'User has been deleted.');
    }

    public function new_order()
    {
        // echo "13";
        $orders = Order::where('status', 'order')->get()->all();

        return view('admin.orders.new_order', compact('orders'));
    }

    public function get_new_order()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $orders = DB::table('orders')->where('status', 'order')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'nama_depan',
            'nama_belakang',
            'subtotal',
            'items',
            'qty',
            'telepon',
            'email',
            'provinsi',
            'kota',
            'alamat',
            'status',
            'created_at',
        ]);


        $datatables = Datatables::of($orders)
            ->addColumn('total_biaya', function($row){
                return number_format($row->subtotal + 3000);
            })
            ->editColumn('nama_depan', function($row){
                return $row->nama_depan.' '.$row->nama_belakang;
            })
            ->editColumn('created_at', function($row){
                return date('Y-m-d', strtotime($row->created_at));
            })
            ->addColumn('action', function ($row) {
                $btn = '<button type="button" data-toggle="modal" data-target=".bd-example-modal-lg" data-id="'.$row->id.'" data-name="'.$row->nama_depan.' '.$row->nama_belakang.'" data-email="'.$row->email.'" data-product="'.$row->items.'" data-qty="'.$row->qty.'" data-biaya="'.number_format($row->subtotal).'" data-tanggal="'.date('Y-m-d', strtotime($row->created_at)).'" data-telepon="'.$row->telepon.'"  data-kota="'.DB::table('cities')->where('city_id', $row->kota)->value('title').'" data-alamat="'.$row->alamat.'" data-status="'.$row->status.'" class="btn btn-info btn-sm">Detail</button>';

                return $btn;
            })
            ->rawColumns(['total_biaya', 'action', 'created_at'])
            ->addIndexColumn();


        return $datatables->make(true);
    }


}
