<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProductGroupsTable.
 */
class CreateProductGroupsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_groups', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('color_id');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['product_id', 'color_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_groups');
	}
}
