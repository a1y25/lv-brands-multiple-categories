<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	{{ HTML::style('css/bootstrap.css') }}
	{{ HTML::script('js/jquery.js') }}
</head>
<body>
	<div class="container">
		<div class="row">

			<div class="col-sm-6">
				@if($errors->has())
					<div class="alert alert-success">{{$errors->first('success')}}</div>
				@endif

				<!-- edit form -->
				<!-- update route -->
				{{Form::open(array('url'=>'brand/update', 'files'=>true))}}

					<input type="hidden" name="brand_id" value="{{$brand->id}}">

					<div class="form-group">
						<label for="">Brand</label>
						<input type="text" class="form-control input-sm" name="brand" value="{{$brand->name}}">
					</div><!-- end .form-group -->

                    @foreach($brand_categories as $brand_category)
                        <div class="form-group">
                            <label for="">Category</label>
                            <!-- selected value in collection with brand categories pivot value from db -->
                            <!-- matches and applies selected attribute to the <option tag> -->
                            {{Form::select('categories[]', $brand_categories_colxn,
                            			$brand_category->id, ['class' => 'input-sm'])}}
                           	<a href="#" class="btn btn-danger btn-xs btn-remove-cat">
                           		Remove
                           	</a>
                        </div>
                    @endforeach

					<a href="#" class="btn btn-sm btn-info btn-add-cat">Add More Category</a>
                    <button class="btn btn-sm btn-primary">Save</button>
				{{Form::close()}}

				<div class="clearfix"></div>
				<a href="/brand">Back to Brands</a>
			</div>
		</div>
	</div><!-- end .container -->
	<script>
		$('.btn-add-cat').on('click',function(e){
			e.preventDefault();

			var template = '<div class="form-group">'+
                            '<label for="">Category</label> '+
                            '{{Form::select("categories[]", $brand_categories_colxn,null, ["class" => "input-sm"])}} '+
                            '<a href="#" class="btn btn-danger btn-xs btn-remove-cat">Remove</a>'+
                        	'</div>';

			$(this).before(template);

		});

		$(document).on('click', '.btn-remove-cat', function(e){
			e.preventDefault();

			if(confirm('u want to remove this?')){
				$(this).parent('.form-group').remove();
			}
		});
	</script>
</body>
</html>