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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->default('TechHome Computer Services and Accessories');
            $table->string('company_address')->default('Moi South Lake, Kamere');
            $table->string('company_phone')->default('+254 701 83 83 31');
            $table->string('company_email')->default('techhomecomputerservices@gmail.com');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
