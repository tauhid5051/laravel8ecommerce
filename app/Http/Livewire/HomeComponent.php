<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        // dd(session()->all());

        $sliders = HomeSlider::where('status', 1)->get();
        $lProducts  = Product::orderBy('created_at', 'DESC')->get()->take(8);
        $category = HomeCategory::find(1);
        $cats = explode(',', $category->sel_categories);
        $categories = Category::whereIn('id', $cats)->get();
        $no_of_products = $category->no_of_products;
        $on_sale_products = Product::where('sale_price', '>', 0)->inRandomOrder()->limit(10)->get();
        $sale = Sale::find(1);
        return view('livewire.home-component', ['sliders' => $sliders, 'lProducts' => $lProducts, 'categories' => $categories, 'no_of_products' => $no_of_products, 'on_sale_products' => $on_sale_products, 'sale' => $sale])->layout('layouts.base');
    }
}
