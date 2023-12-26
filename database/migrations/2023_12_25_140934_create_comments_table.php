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
        Schema::create('comments', function (Blueprint $table) {
          $table->id();
          $table->foreignId('user_id')->constrained();
          $table->foreignId('post_id')->constrained();
          $table->text('comment_text');
          $table->boolean('moderated')->default(false);
          $table->boolean('approved')->default(false);
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
