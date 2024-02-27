<?php

use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_sns', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Item::class)->constrained()->cascadeOnDelete();
            $table->string('sn');
            $table->string('mac');
            $table->enum('status', ['warehouse', 'reserve', 'out']);
            $table->foreignIdFor(User::class, 'teknisi_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->integer('parent_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_sns');
    }
};
