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
        Schema::create('headersrjs', function (Blueprint $table) {
        $table->id(); 
        $table->dateTime('TglBuat');
        $table->string('NamaTujuan');
        $table->text('AlamatTujuan');
        $table->string('PerusahaanTujuan');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('headersrjs');
    }
};
