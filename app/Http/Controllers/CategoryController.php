<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');
        $categories = \App\Category::where("name", "LIKE", "%$keyword%")->get();
        return $categories;
    }

    public function getcategories()
    {
        DB::statement(DB::raw('set @rownum=0'));
        $categories = DB::table('categories')->select([
            DB::raw('@rownum  := @rownum  + 1 AS rownum'),
            'id',
            'name',
        ]);


        $datatables = Datatables::of($categories)
            ->addColumn('action', function ($row) {
                $btn = '<button data-id="' . $row->id . '" data-name="' . $row->name . '" data-toggle="modal" data-target="#editModal" data-original-title="Edit" class="edit btn btn-info btn-sm edit-user">
                Edit
                </butt>';
                return $btn;
                // dd($row);
            })
            ->rawColumns(['action'])
            ->addIndexColumn();


        return $datatables->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.index')->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'name'      => 'required'
        ])->validate();

        $new_category = new \App\Category;

        $new_category->name = $request->get('name');
        $new_category->slug = str_slug($request->get('name'), '-');
        $new_category->created_by = \Auth::user()->name;

        $new_category->save();

        return redirect('/categories')->with('success', 'Category successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            'name'      => 'required'
        ])->validate();

        // dd($request->all());
        // $data = Category::findOrFail($request->id);

        Category::where('id', $request->id)->update([
            'name' => $request->name,
            'updated_by' => \Auth::user()->name
        ]);

        return redirect('/categories')->with('success', 'Category Successfully Upadte');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return redirect('/categories')->with('success', 'Category Succesfully Deleted');
    }
}
