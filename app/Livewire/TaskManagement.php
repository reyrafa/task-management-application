<?php

namespace App\Livewire;

use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class TaskManagement extends Component
{

    /* ****************************************************
    ** variables and validation **
    ******************************************************* */


    /* *******************************************************
    **********************************************************
    ********************************************************** */


    /* ****************************************************
                ** FOR ADD CATEGORY BUTTON **
    ******************************************************* */
    public $add_category_btn_text = 'Add Category';
    public $add_category_btn_color = 'btn-primary';
    public $add_category_form_display = 'd-none';

    /* ****************************************************
    *******************************************************
    ******************************************************* */


    /* ****************************************************
                    ** ADD TASK BUTTON **
    ******************************************************* */

    public $add_task_btn_text = 'Add Task';
    public $add_task_btn_color = 'btn-primary';
    public $add_task_form_display = 'd-none';

    /* ****************************************************
    *******************************************************
    ******************************************************* */



    /* 
    * Toggle the add category form
    */
    public function toggleAddCategoryButton()
    {

        $this->add_category_btn_text = ($this->add_category_btn_text == 'Add Category') ? 'Close Category Form' : 'Add Category';
        $this->add_category_btn_color = ($this->add_category_btn_color == 'btn-primary') ? 'btn-secondary' : 'btn-primary';
        $this->add_category_form_display = ($this->add_category_form_display == 'd-none') ? 'd-block' : 'd-none';
    }


    /*
    * function to toggle add task form
    * */

    public function toggleAddTaskButton()
    {
        $this->add_task_btn_text = ($this->add_task_btn_text == 'Add Task') ? 'Close Task Form' : 'Add Task';
        $this->add_task_btn_color = ($this->add_task_btn_color == 'btn-primary') ? 'btn-secondary' : 'btn-primary';
        $this->add_task_form_display = ($this->add_task_form_display == 'd-none') ? 'd-block' : 'd-none';
    }

    /**
     * success message
     */
    #[On('success-creation')]
    public function successMessage($message)
    {
        session()->flash($message[0], $message[1]);
    }


    public function render()
    {

        return view('livewire.task-management')
            ->layout('layouts.app', [
                'title' => 'Task Management',
                'page_title' => 'Task Management'
            ]);
    }
}
