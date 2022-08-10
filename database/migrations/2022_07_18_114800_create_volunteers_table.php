<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolunteersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('custom_id')->nullable();
            
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();

            $table->string('address')->nullable();
            $table->string('contact_no')->nullable();
            
            $table->string('image')->nullable();
            
            $table->enum('is_active', ['y', 'n'])->default('y')->nullable();
            $table->enum('status', ['pending', 'approved','reject'])->default('pending')->nullable();
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
        Schema::dropIfExists('volunteers');
    }
}
