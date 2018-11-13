<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategorySaveRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\VueTables\EloquentVueTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function view()
    {
        return view('admin.categories');
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
    public function store(CategorySaveRequest $request)
    {
        $name = $request->name;

        Category::create(
            [
                'name' => $name,
                'slug' => str_slug($name)
            ]
        );

        return;
    }

    public function categoriesJson()
    {
        if(request()->ajax()) {
			$vueTables = new EloquentVueTables;
			$data = $vueTables->get(new Category, ['id','name','created_at'], []);
			return response()->json($data);
		}
		return abort(401);
    }

    /**
     * Display the specified resource.
     *
     
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $name = $request->name;
        $category->name = $name;
        $category->slug = str_slug($name);
        $category->save();
        return; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
