<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBrandsCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('brands_categories', function(Blueprint $table)
		{
			$table->unique(['brand_id', 'category_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('brands_categories', function(Blueprint $table)
		{
			$table->dropUnique(['brand_id','category_id']);
		});
	}

}
