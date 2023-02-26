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
        Schema::create('patient_systems', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Patient::class)->nullable(false)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(\App\Models\System::class)->nullable(false)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->text('condition');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient_systems');
    }
};
