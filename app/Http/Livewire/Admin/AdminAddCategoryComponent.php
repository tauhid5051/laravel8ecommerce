<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use illuminate\Support\Str;

class AdminAddCategoryComponent extends Component
{
    public $name;
    public $slug;
    public function generateslug()
    {
        $this->slug = Str::slug($this->name);
    }
    public function updated($fields){
        $this->validateOnly($fields,[
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);

    }
    public function storeCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories'
        ]);
        $catetory = new Category();
        $catetory->name = $this->name;
        $catetory->slug = $this->slug;
        $catetory->save();
        session()->flash('message','Category has been created successfully');
    }
    public function render()
    {
        return view('livewire.admin.admin-add-category-component')->layout('layouts.base');
    }
}
