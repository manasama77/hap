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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('account_no');
            $table->integer('vendor_partner_id');
            $table->string('location_address');
            $table->integer('install_status');
            $table->string('install_notes');
            $table->integer('reason_1');
            $table->integer('reason_2');
            $table->string('coordinates');
            $table->integer('odp_code');
            $table->string('actual_distance');
            $table->integer('cable_length');
            $table->integer('item_sn_id');
            $table->integer('redaman');

            $table->integer('technician_group_id');
            $table->integer('installer_id_1');
            $table->integer('installer_id_2');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_orders');
    }
};
