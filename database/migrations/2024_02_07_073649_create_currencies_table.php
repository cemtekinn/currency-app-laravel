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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("selling_rate");
            $table->string("buying_rate");
            $table->timestamps();
            $table->charset="utf8";
            $table->collation="utf8_general_ci";
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
