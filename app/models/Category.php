<?php

	class Category extends Eloquent{
		protected $fillable = ['name'];

		//relation
		public function brands(){
			return $this->belongsToMany('Brand', 'brands_categories');
		}
	}

 ?>