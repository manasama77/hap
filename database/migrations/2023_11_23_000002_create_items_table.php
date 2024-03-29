<?php

use App\Models\TipeItem;
use App\Models\CategoryItem;
use Illuminate\Foundation\Auth\User;
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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CategoryItem::class)->constrained();
            $table->foreignIdFor(TipeItem::class)->constrained();
            $table->string('name');
            $table->string('unit');
            $table->integer('qty')->default(0)->unsigned();
            $table->string('photo')->nullable();
            $table->boolean('has_sn')->default(false);
            $table->boolean('in_warehouse')->default(true);
            $table->foreignIdFor(User::class, 'teknisi_id')->nullable()->constrained('users')->onDelete('set null');
            $table->integer('parent_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('deleted_by')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['category_item_id']);
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
            $table->dropForeign(['updated_by']);
            $table->dropColumn('updated_by');
            $table->dropForeign(['deleted_by']);
            $table->dropColumn('deleted_by');
        });

        Schema::dropIfExists('items');
    }
};
