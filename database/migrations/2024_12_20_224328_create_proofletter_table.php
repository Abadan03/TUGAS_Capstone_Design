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
        Schema::create('proofletter', function (Blueprint $table) {
            $table->id();
            $table->string('orders_id')->nullable();
            $table->string('ormawa')->nullable();
            $table->string('event')->nullable();
            $table->text('letter')->nullable();
            // $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proofletter');
    }
};
