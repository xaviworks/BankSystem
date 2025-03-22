<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bank_users', function (Blueprint $table) {
            $table->id();  // Auto-incrementing ID
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('occupation');
            $table->decimal('balance', 15, 2)->default(0.00);  // Store the balance/amount with 2 decimal places
            $table->timestamps();  // Automatically adds created_at and updated_at
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('bank_users');
    }
    

};
