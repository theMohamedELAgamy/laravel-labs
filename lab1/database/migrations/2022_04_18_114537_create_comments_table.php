<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            // $table->integer("id");
            
            // $table->text('body');
            
            
            // $table->Integer('commentable_id');
            // $table->String("commentable_type");
            
            $table->id();
            $table->longText("comment");
            $table->morphs("commentable");
            $table->foreignId("user_id")->references("id")->on("users");
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
        Schema::dropIfExists('comments');
    }
};
