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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('job_title', 100)->nullable();
            $table->string('department', 50)->nullable();
            $table->boolean('is_primary_contact')->default(false);
            $table->text('notes')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('office_phone_number', 50)->nullable();
            $table->string('mobile_phone_number', 50)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
    
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });
    }
    
};
