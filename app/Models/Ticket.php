<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'category_id',
        'agent_id',
        'status',
        'priority'

    ];

    /**
     * Get the user that owns the ticket.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function agent() {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function responses() {
        return $this->hasMany(ResponseTicket::class);
    }
}
