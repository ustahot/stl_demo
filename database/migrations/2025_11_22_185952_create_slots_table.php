<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return app(\App\Models\Slot::class)->getTable();
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('capacity');
            $table->unsignedInteger('remaining');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(self::getTableName());
    }
};
