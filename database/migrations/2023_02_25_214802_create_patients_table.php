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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('Dui')->unique();
            $table->string('name');
            $table->string('lastname');
            $table->string('genre');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('second_phone');
            $table->text('address');
            $table->string('occupation');
            $table->date('birthdate');
            $table->foreignIdFor(\App\Models\clinic\BranchOffice::class)->nullable(false)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->string('contact_name');
            $table->string('contact_phone');
            $table->string('contact_email')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
