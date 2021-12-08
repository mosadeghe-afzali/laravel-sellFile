<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('file_name' , 20);
            $table->bigInteger('size');
            $table->bigInteger('price');
            $table->string('type' , 10);
            $table->text('description');
            $table->date('upload_date');
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->boolean('is_gust')->default(0)->nullable();
            $table->string('guest_ip')->nullable();
            $table->boolean('is_confirmed')->default(0);
            $table->integer('download_numbers');
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
        Schema::dropIfExists('files');
    }
}
