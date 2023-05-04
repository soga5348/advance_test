<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('postal_code');
            $table->string('address');
            $table->string('building')->nullable();
            $table->text('message');
            $table->timestamps();
            $table->dropColumn('name');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable(false);
            $table->string('gender')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
