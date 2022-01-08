<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->float('price');
            $table->float('liter');
            $table->string('payment_type')->default('TTS');
            $table->integer('km');
            $table->date('p_date');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->dropForeign('lists_vehicle_id_foreign');
            $table->dropForeign('lists_user_id_foreign');
            $table->dropIndex('lists_vehicle_id_index');
            $table->dropIndex('lists_user_id_index');
        });
        Schema::dropIfExists('purchases');
    }
}
