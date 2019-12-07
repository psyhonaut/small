<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\TicketReply::class, function (Faker $faker) {
  $ticket = DB::table('tickets')->orderBy('id', 'DESC')->first();
  $user = ( rand(0,1) ? rand(9,10) : $ticket->user_id );
  $timestart = $ticket->created_at;
  $timeend = "2019-12-31 18:00:00";
  $newtime = rand(strtotime($timestart), strtotime($timeend));
    return [
      'ticket_id'   => $ticket->id,
      'user_id'     => $user,
      'description' => $faker->text(rand(40, 100)),
      'created_at'  => date('Y-m-d H:i:s', $newtime),
      'updated_at'  => date('Y-m-d H:i:s', $newtime)
    ];
});
