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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('title', 155)->nullable();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('google_analytic_code')->nullable();
            $table->string('google_adsense_code')->nullable();
            $table->json('quick_links')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
