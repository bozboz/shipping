<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaxRateToShippingCosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipping_costs', function (Blueprint $table) {
            $table->decimal('tax_rate', 4, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipping_costs', function (Blueprint $table) {
            $table->dropColumn('tax_rate');
        });
    }
}
