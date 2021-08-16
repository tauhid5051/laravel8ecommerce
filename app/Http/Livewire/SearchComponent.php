<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;


class SearchComponent extends Component
{
    public $sorting;
    public $pagesize;

    public $search;
    public $product_cat;
    public $product_cat_id;

    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize= 10;
        $this->fill(request()->only('search','product_cat','product_cat_id'));
    }

    public function store($productId,$productName,$product_price)
    {
        Cart::add($productId,$productName,1,$product_price )->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }


    use WithPagination;
    public function render()
    {

        // dd($this->product_cat_id);


        switch ($this->sorting) {
            case "default":
                DB::enableQueryLog();

                $products = Product::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->paginate($this->pagesize);
                // and then you can get query log

                // dd(DB::getQueryLog());
                // dd($products);

                break;
            case "date":
                $products = Product::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('created_at','DESC')->paginate($this->pagesize);
              break;
            case "price":
                $products = Product::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('regular_price','ASC')->paginate($this->pagesize);
              break;
            case "price-desc":
                $products = Product::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('regular_price','DESC')->paginate($this->pagesize);
              break;
            case "name":
                $products = Product::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('name','ASC')->paginate($this->pagesize);
              break;
            case "name-desc":
                $products = Product::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('name','DESC')->paginate($this->pagesize);
              break;
            default:
            $products = Product::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->paginate($this->pagesize);
          }

          $categories = Category::all();


        //   dd( $products->count());


        return view('livewire.search-component',['products' => $products,'categories' => $categories])->layout('layouts.base');
    }
}
