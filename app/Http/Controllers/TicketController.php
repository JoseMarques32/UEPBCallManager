<?php

namespace App\Http\Controllers;
use App\Models\Ticket;

class TicketController
{
    public function index() {
       $ticket = Ticket::find(18);
       return $ticket->agent->name;    
    }
}
