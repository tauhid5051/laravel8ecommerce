<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        // dd(session()->all());


        return view('livewire.home-component')->layout('layouts.base');
    }
}
