<?php

	class Brand extends Eloquent{
		protected $fillable = ['name'];

		//relation
		public function categories(){
			return $this->belongsToMany('Category', 'brands_categories');
		}
	}
 ?>