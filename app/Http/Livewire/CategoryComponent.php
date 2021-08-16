<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    public $sorting;
    public $pagesize;
    public $category_slug;

    public function mount($category_slug)
    {
        $this->sorting = "default";
        $this->pagesize= 10;
        $this->category_slug= $category_slug;
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
        $category = Category::where('slug',$this->category_slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;

        switch ($this->sorting) {
            case "default":
                $products = Product::where('category_id',$category_id)->paginate($this->pagesize);
              break;
            case "date":
                $products = Product::where('category_id',$category_id)->orderBy('created_at','DESC')->paginate($this->pagesize);
              break;
            case "price":
                $products = Product::where('category_id',$category_id)->orderBy('regular_price','ASC')->paginate($this->pagesize);
              break;
            case "price-desc":
                $products = Product::where('category_id',$category_id)->orderBy('regular_price','DESC')->paginate($this->pagesize);
              break;
            case "name":
                $products = Product::where('category_id',$category_id)->orderBy('name','ASC')->paginate($this->pagesize);
              break;
            case "name-desc":
                $products = Product::where('category_id',$category_id)->orderBy('name','DESC')->paginate($this->pagesize);
              break;
            default:
            $products = Product::where('category_id',$category_id)->paginate($this->pagesize);
          }

          $categories = Category::all();

        //   dd($categories);


        return view('livewire.category-component',['products' => $products,'categories' => $categories,'category_name' => $category_name])->layout('layouts.base');
    }
}
