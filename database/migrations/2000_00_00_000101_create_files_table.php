<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');

            $table->char('short_id', 8)->unique();
            $table->string('type', 8)->comment('video | audio | image | document');
            $table->string('extension', 8);
            $table->unsignedBigInteger('size');
            $table->string('original_name');
            $table->string('name', 20);
            $table->string('url');
            $table->string('title');
            $table->text('description');

            $table->string('what')->nullable();
            $table->string('where')->nullable();
            $table->date('when')->nullable();
            $table->string('who')->nullable();

            $table->timestamps();
        });

        Schema::table('files', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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