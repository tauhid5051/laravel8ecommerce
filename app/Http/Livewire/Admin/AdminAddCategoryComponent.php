<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminAddCategoryComponent extends Component
{
    public $name;
    public $slug;
    public function generateslug()
    {
        $this->slug = Str::slug($this->name);

    }
    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->layout('layouts.base');
    }
}
