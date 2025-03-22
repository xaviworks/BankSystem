<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('bank_users', function (Blueprint $table) {
            $table->boolean('is_deleted')->default(false); // Soft delete flag
        });
    }

    public function down()
    {
        Schema::table('bank_users', function (Blueprint $table) {
            $table->dropColumn('is_deleted');
        });
    }
};
