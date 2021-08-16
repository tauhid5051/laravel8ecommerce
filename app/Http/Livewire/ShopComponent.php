<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;


class ShopComponent extends Component
{
    public $sorting;
    public $pagesize;

    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize= 10;
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

        // dd($this->sorting);


        switch ($this->sorting) {
            case "default":
                $products = Product::paginate($this->pagesize);
              break;
            case "date":
                $products = Product::orderBy('created_at','DESC')->paginate($this->pagesize);
              break;
            case "price":
                $products = Product::orderBy('regular_price','ASC')->paginate($this->pagesize);
              break;
            case "price-desc":
                $products = Product::orderBy('regular_price','DESC')->paginate($this->pagesize);
              break;
            case "name":
                $products = Product::orderBy('name','ASC')->paginate($this->pagesize);
              break;
            case "name-desc":
                $products = Product::orderBy('name','DESC')->paginate($this->pagesize);
              break;
            default:
            $products = Product::paginate($this->pagesize);
          }

          $categories = Category::all();

        //   dd( $categories);


        return view('livewire.shop-component',['products' => $products,'categories' => $categories])->layout('layouts.base');
    }
}
