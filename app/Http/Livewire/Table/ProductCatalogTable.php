<?php

namespace App\Http\Livewire\Table;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Livewire\WithPagination;
class ProductCatalogTable extends Component
{
    use WithPagination;
    public $search;
    public $filterbycategory;
    public $filterbybrand;

    public $perPage = 24;
    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterbycategory()
    {
        $this->resetPage();
    }
    public function updatingFilterbybrand()
    {
        $this->resetPage();
    }

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function render()
    {
        $categories = Category::orderby('name')->get();
        $brands = Brand::orderby('name')->get();

        $products = Product::where('status',1)
        ->where('name','like','%'.$this->search.'%')
        ->where('category_id','like','%'.$this->filterbycategory.'%')
        ->where('brand_id','like','%'.$this->filterbybrand.'%')
        ->with('images','category','brand')
        ->orderby('name', 'asc')
        ->paginate($this->perPage);


        return view('livewire.table.product-catalog-table',[
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
}
