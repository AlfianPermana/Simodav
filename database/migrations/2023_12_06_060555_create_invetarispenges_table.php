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
        Schema::create('invetarispenges', function (Blueprint $table) {
            $table->id();
			$table->timestamps();
			$table->string('penanggungjawab');
			$table->decimal('totalpengeluaran', 8, 2);
			$table->string('notaimage')->nullable();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invetarispenges');
    }
};
