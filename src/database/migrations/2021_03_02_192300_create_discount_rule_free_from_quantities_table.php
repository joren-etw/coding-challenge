<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountRuleFreeFromQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_rule_free_from_quantities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->decimal('from_quantity', 8, 2);
            $table->decimal('free_quantity', 8, 2);
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
        Schema::dropIfExists('discount_rule_free_from_quantities');
    }
}
