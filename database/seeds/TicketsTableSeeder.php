<?php

use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tickets = [];
        $timestart = "2019-12-07 08:00:00";
        $timeend = "2019-12-31 18:00:00";

        for( $i = 1; $i <= 30; $i++ )
        {
          $clientID = rand(1, 8);
          $newtime = rand(strtotime($timestart), strtotime($timeend));

          $ticket = [
            'department_id' => rand(1, 3),
            'user_id'       => $clientID,
            'title'         => 'Возникла проблема с установкой программы #' . $i,
            'description'   => 'При установки программы выходит ошибка #' . rand(1, 9) . '00',
            'active'        => rand(0, 1),
            'created_at'    => date('Y-m-d H:i:s', $newtime),
            'updated_at'    => date('Y-m-d H:i:s', $newtime)
          ];

          DB::table('tickets')->insert($ticket);

          factory(App\TicketReply::class, rand(2, 5))->create();

        }

    }
}
