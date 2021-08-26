<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Sale;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{
    public function store($productId,$productName,$product_price)
    {
        Cart::add($productId,$productName,1,$product_price )->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }



    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $product = Product::where('slug',$this->slug)->first();
        $popular_product = Product::inRandomOrder()->limit(4)->get();
        $related_product = Product::where('category_id',$product->category_id)->inRandomOrder()->limit(5)->get();
        $sale = Sale::find(1);
        // dd($related_product);
        return view('livewire.details-component',['product'=>$product,'popular_product'=>$popular_product,'related_product'=>$related_product, 'sale'=>$sale])->layout('layouts.base');
    }
}
