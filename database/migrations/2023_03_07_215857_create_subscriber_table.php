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
        Schema::create('subscriber', function (Blueprint $table) {
            $table->id();
            $table->string('lastname', 200);
            $table->string('firstname', 200);
            $table->string('middlename', 200)->nullable();
            $table->string('address', 255);
            $table->char('gender', 1);
            $table->datetime('createddatetime')->useCurrent();
            $table->datetime('deleteddatetime')->nullable();
            $table->datetime('updateddatetime')->nullable();
            $table->boolean('deleted');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriber');
    }
};
