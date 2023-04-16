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
        Schema::create('family_backgrounds', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\clinic\Patient::class)->nullable(false)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(\App\Models\clinic\System::class)->nullable(false)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('relationship');
            $table->string('condition');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('family_backgrounds');
    }
};
