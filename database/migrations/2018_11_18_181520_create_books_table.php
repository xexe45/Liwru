<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('isbn');
            $table->string('title');
            $table->string('picture');
            $table->string('liwru_code')->unique();
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('author_book', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author_id');
            $table->foreign('author_id')->references('id')->on('authors');
            $table->unsignedInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books');
            $table->timestamps();
        });

        Schema::create('book_category', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books');
            $table->timestamps();
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
        });

        
        Schema::create('book_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('description');
            $table->enum('condicion', ['NUEVO','SEMINUEVO','VIEJO']);
            $table->enum('status', [ 
                \App\Book::NO_DISPONIBLE,
                \App\Book::DISPONIBLE,
                \App\Book::INTERCAMBIADO
            ])->default(\App\Book::DISPONIBLE);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
        Schema::dropIfExists('author_book');
        Schema::dropIfExists('book_category');
        Schema::dropIfExists('book_user');
    }
}
