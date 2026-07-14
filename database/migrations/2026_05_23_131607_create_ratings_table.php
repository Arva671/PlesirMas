<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('ratings', function (Blueprint $table) {
    $table->id();

    $table->integer('user_id');

    $table->integer('wisata_id');

    $table->float('rating');

    $table->text('comment')->nullable();

    $table->timestamps();
});
}

};