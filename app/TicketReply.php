<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $fillable
      = [
        'ticket_id',
        'user_id',
        'description'
      ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function ticket()
  {
      return $this->belongsTo(Ticket::class);
  }
}
