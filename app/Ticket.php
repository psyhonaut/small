<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
  protected $dates = ['created_at'];
  protected $fillable
    = [
      'department_id',
      'user_id',
      'title',
      'description'
    ];

    /*
     * Получить все ответы и отсориторовать по убыванию
     */
    public function replyLast()
    {
      return $this->hasMany('App\TicketReply')->orderBy('created_at', 'desc');
    }

  /*
   * Получить все ответы и отсориторовать по возрастанию
   */
  public function replyAll()
  {
    return $this->hasMany('App\TicketReply')->orderBy('created_at', 'asc');
  }
}
