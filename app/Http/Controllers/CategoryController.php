<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::latest()->paginate(5);
        
        //echo '<pre>'; print_r($category);
        return view('category.list',compact('category'))->with('i', (request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $requestvalidate = $request->validate([
            'category_name' => 'required|max:255',
            'status'        => 'required|numeric',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = new Category;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = str_slug(md5(time())).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/category');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $category->image_url = 'uploads/category/'.$name;
        }
        $category->name = $request->category_name;
        $category->is_active = $request->status;
        $category->save();
        return redirect()->route('category.index')
                        ->with('success','Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $requestvalidate = $request->validate([
            'category_name' => 'required|max:255',
            'status'        => 'required|numeric',
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = str_slug(md5(time())).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/category');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);

            $image_path = $category->image_url;
            if($image_path){
                unlink($image_path);
            }
            //echo $image_path; exit;
            $category->image_url = 'uploads/category/'.$name;
        }

        $category->name = $request->category_name;
        $category->is_active = $request->status;
        $category->save();
        return redirect()->route('category.index')
                        ->with('success','Category Updated successfully.');
        //echo $id;
        //$comment = Comment::find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        $image_path = $category->image_url;
        if($image_path){
            unlink($image_path);
        }
        $category->delete();
        return redirect()->route('category.index')
                        ->with('success','Category deleted successfully');
    }
}
