<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

  /*
   * Получить последний ответ на заявку
   */
  public function reply()
  {
    return $this->hasMany('App\TicketReply')->orderBy('created_at', 'asc');
  }

}
