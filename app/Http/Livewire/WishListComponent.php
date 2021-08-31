<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class WishListComponent extends Component
{
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


    public function moveProductFromWishlistToCart($rowId){
        // dd($rowId);
        $item = Cart::instance('wishlist')->get($rowId);
        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('cart')->add($item->id,$item->name,1,$item->price )->associate('App\Models\Product');
        $this->emitTo('wishlist-count-component','refreshComponent');
        $this->emitTo('cart-count-component','refreshComponent');

    }

    public function render()
    {
        return view('livewire.wish-list-component')->layout('layouts.base');
    }
}
