<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->tinyInteger('role_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('id_no');
            $table->tinyInteger('status')->comment('0:Pending,1:Active');
            $table->rememberToken();
            $table->timestamps();
        });
        $data[] = [
            'role_id' => 1,
            'first_name' => 'Admin',
            'last_name' => 'user',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'),
            'status' => 1,
            'id_no' => 'OA00001'
        ];
        DB::table('users')->insert($data);
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
