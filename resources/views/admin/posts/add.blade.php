@extends('layouts.adminPages')
@section('content')
<div class="x_content">
		<br />
		<form action="{{route('storePost')}}" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
		@csrf
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Title <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
				<input type="text" id="title"  class="form-control "name="title" value="{{old('title')}}">
				<div style="color : red;">
					@error('title')
                      {{$message}}
                    @enderror</div>
			</div>
		</div>
		<div class="item form-group">
			<label class="col-form-label col-md-3 col-sm-3 label-align" for="content">Body <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 ">
				<textarea id="content" name="body"  class="form-control" >{{old('body')}}</textarea>
				<div style="color : red;">
					@error('body')
                      {{$message}}
                    @enderror</div>
			</div>
		</div>

		
		<div class="ln_solid"></div>
		<div class="item form-group">
			<div class="col-md-6 col-sm-6 offset-md-3">
				<button class="btn btn-primary" type="button"><a href="{{route('listPost')}}">Cancel</a></button>
				<button type="submit" class="btn btn-success">Add</button>
			</div>
		</div>

	</form>
</div>
</div>
</div>
</div>

</div>
</div>
@endsection
@section('type')
Manage Posts
@endsection
@section('title')
Add Post
@endsection