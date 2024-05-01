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
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->foreignId('user_id')->default(1)->references('id')->on('user')->onDelete('cascade')->onUpdate('cascade');
            $table->string('description');
            $table->string('image');
            $table->text('content');
            $table->integer('view_count')->default(0);
            $table->timestamps();
        });
       
       
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};
