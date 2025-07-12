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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('industry_id')->nullable();
            $table->string('website', 100)->nullable();
            $table->string('logo_url', 255)->nullable();
            $table->date('founded_date')->nullable();
            $table->string('tax_id', 30)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
    
            $table->foreign('industry_id')->references('id')->on('industries')->nullOnDelete();
        });
    }
    
};
