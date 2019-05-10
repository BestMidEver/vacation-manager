<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id')->primary()->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->tinyInteger('notification')->default(1);
                // 0 | No notification
                // 1 | Email notification
            $table->tinyInteger('hierarchy')->default(0);
                // 0 | Pending Employee
                // 1 | Employee
                // 2 | Pending Administrator
                // 3 | Administrator
                // 4 | Architect
            $table->string('administrator_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
