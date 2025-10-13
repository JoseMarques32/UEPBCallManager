<?php

namespace App\Livewire;

use App\Models\ResponseTicket;
use App\Models\Ticket;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TicketResponseForm extends Component
{   

    public $ticket;
    public $message = '';

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function sendresponse() 
    {
        $user = Auth::user();

        if($user->role !== 'staff') {
            session()->flash('error','Apenas um Staff pode responder a um chamado');
            return;
        }

        $this->validate([
            'message' => 'required|min:10'
        ]);

        ResponseTicket::create([
            'ticket_id' => $this->ticket->id,
            'user_id' => $user->id,
            'message' => $this->message
        ]);

        $this->message = '';
        $this->ticket->load('responses.user');

        session()->flash('success', 'Resposta Enviada Com Sucesso!!');

    }

    public function render()
    {
        return view('livewire.ticket-response-form');
    }
}
