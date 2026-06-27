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
        Schema::create('backup_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId("triggered_by")->constrained("users")->onDelete("cascade");
            $table->string("backup_type");
            $table->text("status");
            $table->string("file_path")->nullable();
            $table->timestamps("created_at");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('backup_log');
    }
};
