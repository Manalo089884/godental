<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Supplier;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExport;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    //Show Product Table
    public function index(){
        abort_if(Gate::denies('product_access'),403);
        return view('admin.page.product.product');
    }

    //Show Add Product Form
    public function create(){
        abort_if(Gate::denies('product_create'),403);
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        return view('admin.page.Product.productadd',[
            'categories' => $categories,
            'brands' => $brands,
            'suppliers' => $suppliers
        ]);
    }

    //Store Product in Database
    public function store(StoreProductRequest $request){
        abort_if(Gate::denies('product_create'),403);
        $request->validated();
        $archived = $request->boolean('status');
        $new_product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category,
            'brand_id' => $request->brand,
            'suppliers_id' => $request->supplier,
            'stock' => $request->stock,
            'SKU' => $request->SKU,
            'cprice' => $request->cprice,
            'sprice' => $request->sprice,
            'weight' => $request->weight,
            'status' => $archived,
            'stock_warning' => $request->w_stock,
            'description' => $request->description,

        ]);

        if($request->has('images')){
            foreach($request->file('images') as $image){
            $imageName = time().$image->getClientOriginalName();
            $image->move(public_path('product_images'),$imageName);
            ProductImage::create([
                'product_id' => $new_product->id,
                'images' =>  $imageName,
            ]);
            }
        }
        return redirect()->route('product.index')->with('success', $request->name .' was successfully inserted');
    }
    //Show Edit Product Page
    public function edit(Product $product){
        abort_if(Gate::denies('product_edit'),403);
        //$product = Product::findorFail($id);
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        $images = $product->images;

        return view('admin.page.product.productedit', compact('product'),[
            'categories' => $categories,
            'brands' => $brands,
            'suppliers' => $suppliers,
            'images' => $images,
        ]);
    }

    //Update Product Info from database
    public function update(Request $request,$id ){
        abort_if(Gate::denies('product_edit'),403);
        $this->validate($request, array(
            'name'=> "required|unique:product,name,$id",
            'category' => 'required',
            'brand' => 'required',
            'supplier' => 'required',
            'stock' => 'required|numeric|min:0',
            'w_stock' => 'required|numeric|min:0',
            'SKU' => 'required',
            'cprice' => 'required|numeric|min:0',
            'sprice' => 'required|numeric|min:0',
            'weight' => 'required|numeric',
            'description' => 'required',

        ));
        //$request->validated();
        $product = Product::findorFail($id);
        $status = $request->boolean('status');

        $product->name = $request->input('name');
        $product->category_id = $request->input('category');
        $product->brand_id = $request->input('brand');
        $product->suppliers_id = $request->input('supplier');
        $product->stock = $request->input('stock');
        $product->stock_warning = $request->input('w_stock');
        $product->SKU = $request->input('SKU');
        $product->cprice = $request->input('cprice');
        $product->sprice = $request->input('sprice');
        $product->weight = $request->input('weight');
        $product->status = $status;
        $product->description = $request->input('description');
        $product->update();

        return redirect()->route('product.index')->with('ProductEditSuccess', $request->name .' was successfully Edit');

    }


    //Show Product Page Info
    public function show(Product $product){
        abort_if(Gate::denies('product_show'),403);
        return view('admin.page.product.productshow', compact('product'));
    }
      //Show Product Archive Page
      public function ProductArchiveIndex(){
        abort_if(Gate::denies('product_archive_access'),403);
        $products = Product::onlyTrashed()->orderBy('name')->paginate(20);
        return view('admin.page.product.productarchive',[
            'products' => $products
        ]);
      }

    //Export Product to Excel
    public function exportproductexcel(){
        abort_if(Gate::denies('product_export'),403);
        return Excel::download(new ProductExport,'products.xlsx');
    }

    //Export Product to CSV
    public function exportproductcsv(){
        abort_if(Gate::denies('product_export'),403);
        return Excel::download(new ProductExport,'products.csv');
    }

    //Export Product to HTML
    public function exportproducthtml(){
        abort_if(Gate::denies('product_export'),403);
        return Excel::download(new ProductExport,'products.html');
    }

    //Export Product to PDF
    public function exportproductpdf(){
        abort_if(Gate::denies('product_export'),403);
        return Excel::download(new ProductExport,'products.pdf');
    }
}
