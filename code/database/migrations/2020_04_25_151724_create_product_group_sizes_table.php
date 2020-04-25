<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProductGroupSizesTable.
 */
class CreateProductGroupSizesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_group_sizes', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('product_group_id');
            $table->integer('size_id');
            $table->string('sku')->unique();
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['product_group_id', 'size_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_group_sizes');
	}
}
