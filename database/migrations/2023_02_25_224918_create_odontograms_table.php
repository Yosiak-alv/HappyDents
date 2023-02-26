<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('odontograms', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Detention::class)->nullable(false)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(\App\Models\Patient::class)->nullable(false)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('condition')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('odontograms');
    }
};
