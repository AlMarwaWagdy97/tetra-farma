<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPromoCodeAndDiscountToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('promo_code_id')->nullable()->after('payment_method_id');
            $table->decimal('discount', 10, 2)->default(0)->after('promo_code_id');

            $table->foreign('promo_code_id')
                  ->references('id')->on('promo_codes')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['promo_code_id']);
            $table->dropColumn(['promo_code_id', 'discount']);
        });
    }
}
