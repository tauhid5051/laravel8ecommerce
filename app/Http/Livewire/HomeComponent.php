<?php

namespace App\Http\Livewire;

use App\Models\HomeSlider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        // dd(session()->all());

$sliders = HomeSlider::where('status',1)->get();
        return view('livewire.home-component',['sliders'=>$sliders])->layout('layouts.base');
    }
}
