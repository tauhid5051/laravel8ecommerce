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

    public $min_price;
    public $max_price;

    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize= 10;

        $this->min_price= 1;
        $this->max_price= 1000;
    }


    public function store($productId,$productName,$product_price)
    {
        Cart::instance('cart')->add($productId,$productName,1,$product_price )->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }

    public function addToWishList($productId,$productName,$product_price)
    {
        Cart::instance('wishlist')->add($productId,$productName,1,$product_price )->associate('App\Models\Product');
        $this->emitTo('wishlist-count-component','refreshComponent');
    }

    public function removeFromWishList($productId){
        // dd(Cart::instance('wishlist')->content());
        foreach ( Cart::instance('wishlist')->content() as $wItem) {
            if ($wItem->id == $productId) {
                Cart::instance('wishlist')->remove($wItem->rowId);
                $this->emitTo('wishlist-count-component','refreshComponent');
                return;
            }
        }
    }

    use WithPagination;
    public function render()
    {

        // dd($this->sorting);


        switch ($this->sorting) {
            case "default":
                $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->paginate($this->pagesize);
              break;
            case "date":
                $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('created_at','DESC')->paginate($this->pagesize);
              break;
            case "price":
                $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','ASC')->paginate($this->pagesize);
              break;
            case "price-desc":
                $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('regular_price','DESC')->paginate($this->pagesize);
              break;
            case "name":
                $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('name','ASC')->paginate($this->pagesize);
              break;
            case "name-desc":
                $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->orderBy('name','DESC')->paginate($this->pagesize);
              break;
            default:
            $products = Product::whereBetween('regular_price',[$this->min_price,$this->max_price])->paginate($this->pagesize);
          }

          $categories = Category::all();

          // dd( $products);


        return view('livewire.shop-component',['products' => $products,'categories' => $categories])->layout('layouts.base');
    }
}
