<?php

namespace App\Livewire;

use Livewire\Component;
use app\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketList extends Component
{

     public $tickets;

    public function mount()
    {
        if (Auth::user()->role != 'staff') {
            $this->tickets = Ticket::where('user_id', Auth::id())->get();

        } else {
            $this->tickets = Ticket::all();
        }
        
    }

    public function render()
    {
        return view('livewire.ticketlist',[
            'tickets' => $this->tickets
        ]);
    }
}
