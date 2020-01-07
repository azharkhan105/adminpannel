<?php

namespace App\Http\Controllers;

use App\Subcategory;
use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = DB::table('subcategories')
            ->join('categories', 'categories.id', '=', 'subcategories.category_id')
            ->select('subcategories.*', 'categories.name as cat_name')
            ->where('categories.is_active', '=', 1)
            ->orderBy('subcategories.id', 'desc')
            ->paginate(5);

        //echo '<pre>'; print_r($subcategories); exit;
        return view('subcategory.list', compact('subcategories'))->with('i', (request()->input('page',1)-1)*5);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category= Category::where('is_active', '=', '1')->get();
        return view('subcategory.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subcategory = new Subcategory;
        $requestvalidate =  $request->validate([
            'category_id' => 'required|numeric',
            'subcategory_name' => 'required|max:255',
            'status' => 'required|numeric',
            'image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = str_slug(md5(time())).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/subcategory');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $subcategory->image_url = 'uploads/subcategory/'.$name;
        }

        
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->subcategory_name;
        $subcategory->is_active = $request->status;
        $subcategory->save();

        return redirect()->route('subcategory.index')->with('success', 'Subcategory created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        $category= Category::where('is_active', '=', '1')->get();
        return view('subcategory.edit', compact('subcategory','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::find($id);
        $requestvalidate =  $request->validate([
            'category_id' => 'required|numeric',
            'subcategory_name' => 'required|max:255',
            'status' => 'required|numeric',
            'image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = str_slug(md5(time())).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/subcategory');
            $imagePath = $destinationPath. "/".  $name;
            $image->move($destinationPath, $name);
            $image_path = $subcategory->image_url;
            if($image_path){
                unlink($image_path);
            }
            $subcategory->image_url = 'uploads/subcategory/'.$name;
        }

        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->subcategory_name;
        $subcategory->is_active = $request->status;
        $subcategory->save();

        return redirect()->route('subcategory.index')->with('success', 'Subcategory Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $image_path = $subcategory->image_url;
        if($image_path){
            unlink($image_path);
        }
        $subcategory->delete();
        return redirect()->route('subcategory.index')->with('success', 'Subcategory deleted successfully.');
    }
}
