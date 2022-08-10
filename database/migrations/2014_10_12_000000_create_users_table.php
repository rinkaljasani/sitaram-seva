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
            $table->string('custom_id')->nullable();
            
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->unique()->nullable();

            $table->string('country_code')->nullable();
            $table->string('contact_no')->nullable();
            
            $table->string('profile_photo')->nullable();
            
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->enum('is_active', ['y', 'n'])->default('y')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
