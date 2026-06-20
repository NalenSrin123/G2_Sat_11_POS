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
    Schema::create('personal_access_tokens', function (Blueprint $table) {

        $table->id();

        // polymorphic relation
        $table->morphs('tokenable');

        // token name
        $table->string('name');

        // token
        $table->string('token', 64)->unique();

        // abilities / permissions
        $table->text('abilities')->nullable();

        // last used
        $table->timestamp('last_used_at')->nullable();

        // expire
        $table->timestamp('expires_at')->nullable();

        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
