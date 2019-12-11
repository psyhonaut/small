<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

  protected $fillable
    = [
      'department_id',
      'user_id',
      'title',
      'description'
    ];

    /*
     * Получить последний ответ на заявку
     */
    public function replyLast()
    {
      return $this->hasMany('App\TicketReply')->orderBy('created_at', 'desc');
    }

  /*
   * Получить все ответы
   */
  public function replyAll()
  {
    return $this->hasMany('App\TicketReply')->orderBy('created_at', 'asc');
  }
}
