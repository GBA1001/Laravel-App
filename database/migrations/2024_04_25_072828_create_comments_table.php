<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->references('id')->on('post')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->default(1)->references('id')->on('user')->onDelete('cascade')->onUpdate('cascade');
            $table->string("content");
            $table->timestamps();
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
        Schema::dropIfExists('comment');
    }
};
