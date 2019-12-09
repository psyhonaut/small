<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTicketReplyUser extends Migration
{
  public function up()
  {
      Schema::table('ticket_replies', function (Blueprint $table) {
          $table->unsignedBigInteger('user_id')->after('ticket_id');
          $table->foreign('user_id')->references('id')->on('users');
      });

  }

  public function down()
  {
      Schema::table('ticket_replies', function (Blueprint $table) {
          $table->dropForeign(['user_id']);
          $table->dropColumn('user_id');
      });
  }
}
