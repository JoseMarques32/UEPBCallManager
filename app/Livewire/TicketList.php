<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketList extends Component
{
    public $statusfilter = 'all'; 

     public $tickets;

    public function mount()
    {
        if (Auth::user()->role != 'staff') {
            $this->tickets = Ticket::where('user_id', Auth::id())->get();

        } else {
            $this->tickets = Ticket::all();
        }
        
    }
    
    public function claimTicket(Ticket $ticket) 
    {
        $user = Auth::user();

        if($user->role !== 'staff') {
            return redirect()->back()->with('error', 'Apenas um staff pode atribuir chamados!');
        }

        if($ticket->agent_id !== null) {
            return redirect()->back()->with('error', 'ticket já foi atribuido!');
        }

        $ticket->agent_id = $user->id;
        $ticket->status = 'Em Progresso';
        $ticket->save();

        return redirect()->back()->with('success', 'Chamado atribuido com sucesso!');
    }


    public function RespondTicket() 
    {
        
    }

    public function render()
    {
        return view('livewire.ticketlist',[
            'tickets' => $this->tickets
        ]);
    }
}
