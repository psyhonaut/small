<?php

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

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
        $timestart = now()->subMonths(1);
        $timeend = now();

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
            'updated_at'    => date('Y-m-d H:i:s', $newtime),
            'last_active'    => date('Y-m-d H:i:s', $newtime)
          ];

          DB::table('tickets')->insert($ticket);

          factory(App\TicketReply::class, rand(0, 8))->create();

        }

    }
}
