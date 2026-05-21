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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->after('name')->nullable();
            $table->integer('role_id')->after('username')->nullable();
            $table->string('image')->after('role_id')->nullable();
            $table->tinyInteger('status')->default(0)->after('image')->comment('0=Inactive,1=Active');
            $table->dateTime('deleted_at')->after('remember_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
