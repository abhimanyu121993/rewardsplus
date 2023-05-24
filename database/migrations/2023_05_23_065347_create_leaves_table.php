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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->comment('subject leave');
            $table->longText('desc')->comment('description of leave');
            $table->morphs('leaveable');
            $table->timestamp('leave_start')->nullable();
            $table->timestamp('leave_end')->nullable();
            $table->enum('status',['pending','approved','rejected'])->comment('leave status confirmed or pending or rejected');
            $table->longText('leave_rejected_reason')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
