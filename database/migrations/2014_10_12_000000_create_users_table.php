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
            $table->string('first_name', 70);
            $table->string('last_name', 70);
            $table->string('name', 142)->nullable();
            $table->string('username', 100)->nullable();
            $table->string('email', 70)->unique();
            $table->string('mobile', 15)->nullable()->unique();
            $table->string('profile_pic')->nullable();
            $table->string('gender',11)->nullable();
            $table->date('birth_date')->nullable();
            $table->foreignId('country_id')->nullable()->constrained("countries");
            $table->foreignId('city_id')->nullable()->constrained("cities");
            $table->text('address')->nullable();
            $table->string('password');
            $table->boolean('status')->nullable();
            $table->string('referby', 130)->nullable();
            $table->string('referto', 130)->nullable();
            $table->ipAddress('last_login_ip')->nullable();
            $table->timestamp('activated_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes('deleted_at');
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
