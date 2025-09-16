<?php

namespace App\Livewire;

use App\Models\Ticket;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class FormTicket extends Component
{  
    public $title, $description, $user_id, $category_id, $agent_id, $status;

    protected $rules = [
        'title' => 'required|min:10',
        'description' => 'required|min:15',
        'category_id' => 'required|exists:categories,id'
    ];
    
    public function save() 
    {
        $this->validate();

        Ticket::create([
            'title' => $this->title,
            'description' => $this->description,
            'user_id' => Auth::user()->id,  
            'category_id' => $this->category_id,
            'status' => 'Aberto'
        ]);

    }


    public function render()
    {
        return view('livewire.form-ticket',[
            'categories' => Category::all(),
        ]);
    }


    public function cancel() 
    {
        redirect('dashboard');
    }
}
