<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountRulePercentageOnCheapestProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_rule_percentage_on_cheapest_products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->decimal('discount_from', 8, 2);
            $table->decimal('percentage', 8, 2);
            $table->timestamps();
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_rule_percentage_on_cheapest_products');
    }
}
