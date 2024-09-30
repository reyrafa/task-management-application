<?php

namespace App\Livewire;

use App\Models\Categories;
use Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateCategoryForm extends Component
{
    /**
     * category creation
     */
    #[Validate('required|unique:categories,name')]
    public $category_name = '';

    /*
     * function to create category to database
     * */
    public function createCategory()
    {
        $this->validate();
        $category = new Categories();
        $category->user_id = Auth::user()->id;
        $category->name = $this->category_name;
        $category->save();

        $this->reset();

        $this->dispatch('success-creation', message: ['success', 'Category created successfully!']);
    }
    public function render()
    {
        return view('livewire.create-category-form');
    }
}
