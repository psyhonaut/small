<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserRole extends Migration
{
  public function up()
  {
      Schema::table('users', function (Blueprint $table) {
          $table->unsignedSmallInteger('role')->after('name');
      });

      DB::table('users')->update([
          'role' => App\User::ROLE_CLIENT,
      ]);
  }

  public function down()
  {
      Schema::table('users', function (Blueprint $table) {
          $table->dropColumn('role');
      });
  }
}
