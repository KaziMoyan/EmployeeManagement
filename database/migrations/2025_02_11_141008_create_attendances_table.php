<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->timestamp('date_time_in')->nullable();
            $table->timestamp('date_time_out')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('attendances');
    }
};

