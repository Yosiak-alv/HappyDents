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
            $table->foreignIdFor(\App\Models\clinic\Detention::class)->nullable(false)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\clinic\Patient::class)->nullable(false)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('condition')->nullable();

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
