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
        Schema::create('weathers', function (Blueprint $table) {
            $table->id();
            $table->float('elevation');
            $table->string('units');
            $table->string('summary');
            $table->string('temperature');
            $table->string('relative_humidity');
            $table->json('wind');
            $table->json('precipitation');
            $table->float('cloud_cover');
            $table->unsignedBigInteger('place_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('place_id')->references('id')->on('places')
				->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weathers');
    }
};
