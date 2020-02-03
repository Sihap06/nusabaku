<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()) {
            return view('admin.users.index')->with('users', User::paginate(10));
        } else {
            return view('auth.login');
        }
    }

    public function getuser()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $user = DB::table('users')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'name',
            'email',
            'phone',
            'status',
        ]);


        $datatables = Datatables::of($user)->editColumn('name', function ($user) {
            $id = $user->id;
            return '<span id="' . $id . '" style="cursor:pointer;" class="btn-barang">' . $user->name;
        })
            ->addColumn('action', function ($row) {
                $btn = '<a href="users/' . $row->id . '" data-original-title="Edit" class="edit btn btn-info btn-sm edit-user">
                Detail
                </a>';
                return $btn;
                // dd($row);
            })
            ->rawColumns(['name', 'action'])
            ->addIndexColumn();

        // if ($keyword = $request->get('search')['value']) {
        //     $datatables->filterColumn('rownum', 'whereRaw', '@rownum  + 1 like ?', ["%{$keyword}%"]);
        // }

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            "name"      => "required|min:5|max:100",
            "address"   => "required|min:20|max:200",
            "phone"     => "required|digits_between:10,14",
            "email"     => "required|email|unique:users",
            "password"  => "required",
            "confirmpassword" => "required|same:password",
            "avatar"    => "required|mimes:jpg,jpeg,png"
        ])->validate();


        $new_user = new \App\User;
        $userRole = Role::where('name', 'user')->first();

        $new_user->name = $request->get('name');
        $new_user->address = $request->get('address');
        $new_user->phone = $request->get('phone');
        $new_user->email = $request->get('email');
        $new_user->password = \Hash::make($request->get('password'));

        if ($request->file('avatar')) {
            $image_path = $request->file('avatar')->store('avatars', 'public');

            $new_user->avatar = $image_path;
        }

        $new_user->save();
        $new_user->roles()->attach($userRole);
        return redirect()->route('users.create')->with('status', 'User Succesfully created');
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
            return redirect()->route('users.index')->with('warning', 'You are not alllowed to edit yourself');
        }

        return view('admin.users.edit')->with(['user' => User::find($id), 'users' => User::all(), 'roles' => Role::all()]);

        // $user = User::findOrFail($id);
        // // dd($user);
        // return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name'      => 'required|min:5|max:100',
            'email'     => 'required|email',
            'address'   => 'required|min:10|max:200',
            'phone'     => 'required|digits_between:12,14',
            // 'avatar'    => 'mimes:jpg,jpeg,png'
        ]);

        if ($validator->passes()) {
            # code...

            $data = \App\User::findOrFail($request->user_id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->address = $request->address;
            $data->phone = $request->phone;
            $data->status = $request->status;

            $new_avatar = $request->file('avatar');
            // dd($new_avatar);
            if ($request->file('avatar')) {
                $extension = $request->file('avatar')->getClientOriginalExtension();
                $dir = 'avatars/';
                $filename = uniqid() . '_' . time() . '.' . $extension;
                $image_path = $request->file('avatar')->store($dir, $filename, 'public');
                $data->avatar = $image_path;
            }
            // if ($new_avatar) {
            //     if ($data->avatar && file_exists(storage_path('app/public/' . $data->avatar))) {
            //         \Storage::delete('public/' . $data->avatar);
            //     }

            //     $new_data_path = $new_avatar->store('avatars', 'public');

            //     $data->avatar = $new_data_path;
            // }

            $data->save();

            return response()->json(['success' => 'User berhasil disimpan']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
        // dd($request->all());
        // $user->roles()->sync($request->roles);
        // dd($user);

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
            return redirect()->route('users.index')->with('warning', 'You are not alllowed to delete yourself.');
        }

        User::destroy($request->get('hapus_id'));
        return redirect()->route('users.index')->with('success', 'User has been deleted.');
    }

    public function profile(Request $request)
    {

        return view('profile');
    }

    public function gantiFoto(Request $request)
    {
        // dd($request->id);
        $data = User::findOrFail($request->id);

        // dd($data);
        $image = $request->file('gambar');

        if ($image) {
            if ($data->avatar && file_exists(storage_path('app/public/' . $data->avatar))) {
                \Storage::delete('public/' . $data->avatar);
            }

            $new_data_path = $image->store('avatars', 'public');

            $data->avatar = $new_data_path;
        }
        $data->save();

        return back();
    }

    public function editProfile(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name'      => 'required|min:5|max:100',
            'email'     => 'required|email',
            'address'   => 'required|min:10|max:200',
            'phone'     => 'required|digits_between:10,14',
            // 'avatar'    => 'mimes:jpg,jpeg,png'
        ])->validate();

        $data = User::findOrFail($request->id);
        // dd($data);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->phone = $request->phone;
        $data->province_id = $request->province_destination;
        $data->city_id = $request->city_destination;

        $data->save();

        return back();
    }
}
