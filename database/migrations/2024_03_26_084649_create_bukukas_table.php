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
        Schema::create('bukukas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mobil_id')->index();
            $table->timestamp('tanggal');
            $table->text('uraian');
            $table->Biginteger('masuk')->default(0);
            $table->Biginteger('keluar')->default(0);
            $table->foreignId('user_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukukas');
    }
};
