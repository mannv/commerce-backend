<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProductGroupImagesTable.
 */
class CreateProductGroupImagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_group_images', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('product_group_id');
            $table->string('image');
            $table->boolean('cover_image')->default(false);
            $table->boolean('is_crawler')->default(false);
            $table->timestamps();
            $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('product_group_images');
	}
}
