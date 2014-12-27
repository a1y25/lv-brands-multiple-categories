<?php

Route::get('/',function(){
	var_dump('home');
});

//brand
Route::get('/brand', function()
{
	$categories = Category::all();
	$brands = Brand::all();
	return View::make('index')->with('categories', $categories)->with('brands', $brands);
});

//edit route...
Route::get('/brand/edit/{brand_id}',function($brand_id){

	$brand = Brand::find($brand_id);
	$brand_categories = $brand->categories()->get();
	$categories = Category::all();

	//brand categories id key and value collection
	foreach ($categories as $category):
		$brand_categories_colxn[$category->id]= $category->name;
	endforeach;

	return View::make('edit')->with([
		'brand' => $brand,
		'brand_categories' => $brand_categories,
		'brand_categories_colxn' => $brand_categories_colxn
	]);//passing

});

//create route
Route::post('brand/create',function(){

	//multple categories comes in array so.......
	$categories= array_values(Input::get('categories'));
	$brand = Brand::create(['name' => Input::get('brand')]);
	//attach for storing multiple values in relation...
	$brand->categories()->attach($categories);
	return Redirect::back();
});

//update route...
Route::post('brand/update',function(){

	$brand_id = Input::get('brand_id');
	//getting only values from the key value pair with array_values()
	$categories = array_values(Input::get('categories'));

	$brand = Brand::find($brand_id);
	$brand->name = Input::get('brand');
	$brand->save();
	//sync method for updating the added and removed categories dynamically....
	$brand->categories()->sync($categories);

	//redirection
	return Redirect::back()->withErrors(['success' => 'updated successfully hai!!!']);
});