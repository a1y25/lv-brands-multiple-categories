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
				{{Form::open(array('url'=>'brand/create', 'files'=>true))}}
					<div class="form-group">
						<label for="">Brand</label>
						<input type="text" class="form-control input-sm" name="brand">
					</div>

					<!-- cateogories dropdown -->
					 <div class="form-group">
                        <label for="">Category</label>
                        <!-- categories[] array name  -->
                        <select name="categories[]" class="input-sm">
						@foreach($categories as $category)
							<option value="{{$category->id}}">{{$category->name}}</option>
						@endforeach
                        </select>
						<a href="#" class="btn btn-danger btn-xs btn-remove-cat">Remove</a>

                    </div>
					<a href="#" class="btn btn-sm btn-info btn-add-cat">Add More Category</a>
                    <button class="btn btn-sm btn-primary">Save</button>
				{{Form::close()}}
			</div>

			<div class="clearfix"></div>

			<!-- edit list s-->
			<div class="col-sm-5">
				<ul>
					@foreach($brands as $brand)
						<li><a href="/brand/edit/{{$brand->id}}">{{$brand->id .' - '. $brand->name}}</a></li>
					@endforeach
				</ul>
			</div>
		</div>
	</div><!-- end .container -->

	<script>

		//add more categories drop down js
		$('.btn-add-cat').on('click',function(e){
			e.preventDefault();

			var template = ' <div class="form-group">'+
                        '<label for="">Category</label> '+
                        '<select name="categories[]" class="input-sm">' +
						'@foreach($categories as $category)' +
							'<option value="{{$category->id}}">{{$category->name}}</option>'+
						'@endforeach' +
                        '</select>' +
						' <a href="#" class="btn btn-danger btn-xs btn-remove-cat">Remove</a>'+
                    '</div>';

             //append before
			$(this).before(template);

		});

		//remove categories js
		$(document).on('click', '.btn-remove-cat', function(e){
			e.preventDefault();
			$(this).parent('.form-group').remove();
		});

	</script>
</body>
</html>