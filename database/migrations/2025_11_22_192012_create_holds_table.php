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
        return app(\App\Models\Hold::class)->getTable();
    }


    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::getTableName(), function (Blueprint $table) {
            $table->id();
            $table->string('idempotency_key',65)->unique();
            $table->foreignIdFor(\App\Models\Slot::class,'slot_id');
            $table->foreignIdFor(\App\Models\HoldStatus::class,'status_id');
            $table->timestamp('expired_at')->nullable();
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
