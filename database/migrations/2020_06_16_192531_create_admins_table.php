<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->text('username');
            $table->text('added_by');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('create');
            $table->text('edit');
            $table->text('delete');
            $table->text('close');
            $table->text('open');
            $table->text('reopen');
            $table->text('closed');

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
        Schema::dropIfExists('admins');
    }
}
