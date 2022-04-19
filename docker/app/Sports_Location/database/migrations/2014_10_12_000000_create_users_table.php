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
            $table->string('name', 30);
            $table->string('kana', 30);
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('tel')->nullable();
            $table->date('birthday');
            $table->enum('gender', ['男性', '女性', 'その他']);
            $table->string('username', 40);
            $table->string('profile_image')->nullable();
            $table->text('introduction')->nullable();
            $table->softDeletes();
            // $table->unique(['email', 'delete_at'], 'users_email_unique');
            // $table->unique(['username', 'delete_at'], 'users_username_unique');
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
