<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $dates = ['created_at'];
    protected $fillable
      = [
        'ticket_id',
        'user_id',
        'description'
      ];
}
