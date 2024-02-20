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
        Schema::create('item_request_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\ItemRequest::class, 'item_request_id')->nullable();
            $table->foreignIdFor(\App\Models\Item::class, 'item_id');
            $table->foreignIdFor(\App\Models\ItemSn::class, 'item_sn_id')->nullable();
            $table->integer('qty');
            $table->integer('qty_approved')->default(0);
            $table->string('temp_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_request_details');
    }
};
