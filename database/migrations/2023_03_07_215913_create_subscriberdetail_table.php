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
        Schema::create('subscriberdetail', function (Blueprint $table) {
            $table->id();
            $table->string('phoneno', 55);
            $table->string('provider', 55);
            $table->boolean('deleted');
            $table->unsignedBigInteger('headerId')->notNull();
            $table->foreign('headerId')
                ->references('id')->on('subscriber')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriberdetail');
    }
};
