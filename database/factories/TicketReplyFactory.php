<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\TicketReply::class, function (Faker $faker) {
  $ticketObj = DB::table('tickets')->orderBy('id', 'DESC')->first();
  $user = ( rand(0,1) ? rand(9,10) : $ticketObj->user_id );
  $timestart = $ticketObj->created_at;
  $timeend = now();
  $newtime = rand(strtotime($timestart), strtotime($timeend));

  $ticketObj = App\Ticket::find($ticketObj->id);
  $ticketObj->last_active = (strtotime($ticketObj->last_active) < $newtime ? date('Y-m-d H:i:s', $newtime) : $ticketObj->last_active);
  $ticketObj->updated_at = $ticketObj->last_active;
  $ticketObj->save();

    return [
      'ticket_id'   => $ticketObj->id,
      'user_id'     => $user,
      'description' => $faker->paragraph,
      'created_at'  => date('Y-m-d H:i:s', $newtime),
      'updated_at'  => date('Y-m-d H:i:s', $newtime)
    ];
});
