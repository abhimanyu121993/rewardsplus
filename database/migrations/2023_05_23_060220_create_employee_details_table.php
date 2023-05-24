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
        Schema::create('employee_details', function (Blueprint $table) {
            $table->id();
            $table->string('emp_type');
            $table->string('emp_code');
            $table->string('adhar_number')->unique();
            $table->string('pan_number')->unique();
            $table->string('account_number')->unique();
            $table->string('ifsc_code');
            $table->string('photo');
            $table->string('adhar_img');
            $table->string('address_proof');
            $table->string('pancard_img');
            $table->string('other_img');
            $table->string('address');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_details');
    }
};
