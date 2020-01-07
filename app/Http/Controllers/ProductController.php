<?php
namespace App\Http\Controllers;
use App\Product;
use App\Category;
use App\Subcategory;
use App\Products_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')
            ->join('products_images', 'products.id', '=', 'products_images.product_id')
            ->select('products.name','products.sku','products.amount','subcategories.name as subcat_name','categories.name as cat_name', 'products_images.image_url')
            ->where('products.is_active', '=', 1)
            ->orderBy('products.id', 'desc')
            ->groupBy('products.id')
            ->paginate(5);
        echo '<pre>'; print_r($products); exit;
        return view('products.list', compact('products'))->with('i', (request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category= Category::where('is_active', '=', '1')->get();
        $subcategory= Subcategory::where('is_active', '=', '1')->get();
        return view('products.add', compact('category', 'subcategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validaterequest = $request->validate([
            'category_id' => 'required|numeric',
            'subcategory_id'=> 'required|numeric',
            'product_name' => 'required|max:255',
            'sku' => 'required|max:255',
            'price' => 'required|max:255',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|numeric',
        ]);

        if ($request->hasFile('image')) {
            foreach($request->file('image') as $imagedata){
                $name = md5(date("Y-m-d W:G:i:s")).'-'.$imagedata->getClientOriginalName();
                $destinationPath = public_path('/uploads/products');
                $imagePath = $destinationPath. "/".  $name;
                $imagedata->move($destinationPath, $name);
                $productimage[] = 'uploads/products/'.$name;
            }
        }

        $product = new Product;
        $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->name = $request->product_name;
        $product->sku = $request->sku;
        $product->amount = $request->price;
        $product->is_active = $request->status;
        $product->save();

        ///echo '<pre>'; print_r($productimage); exit;
        
        foreach($productimage as $pi){
            $products_image = new Products_image;
            $products_image->product_id = $product->id;
            $products_image->image_url = $pi;
            $products_image->is_active = 1;
            $products_image->save();
        }
        return redirect()->route('product.index')
                        ->with('success','Products created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $category= Category::where('is_active', '=', '1')->get();
        $subcategory= Subcategory::where('is_active', '=', '1')->get();
        return view('products.edit', compact('category', 'subcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
