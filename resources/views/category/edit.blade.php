@extends('layouts.app')
@section('title', 'Category Edit')
@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Edit Category</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
					<li class="breadcrumb-item active">Edit Category</li>
				</ol>
			</div>
		</div>
	</div>
</section>
<!-- Main content -->
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Edit Category</h3>
					</div>
					@if ($errors->any())
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif
					<form role="form" method="post" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
					@csrf
					@method('PUT')
						<div class="card-body">
							<div class="form-group">
								<label for="category_name">Category Name</label>
								<input type="text" class="form-control" id="category_name" placeholder="Category Name" name="category_name" value="{{ $category->name }}">
							</div>
							<div class="form-group">
								@if($category->image_url !='')
									<div>
										<img src="{{ asset($category->image_url) }}" style="width: 100px; height: 100px;">
									</div>
								@endif
			                    <label for="exampleInputFile">Category Image</label>
			                    <div class="input-group">
			                      	<div class="custom-file">
			                        	<input type="file" class="custom-file-input" id="exampleInputFile" name="image">
			                        	<label class="custom-file-label" for="exampleInputFile">Choose file</label>
			                      	</div>
			                      	<div class="input-group-append">
			                        	<span class="input-group-text" id="">Upload</span>
			                      	</div>
			                    </div>
			                </div>
							<div class="form-group">
								<label for="status">Status</label>
								<select name="status" id="status" class="form-control">
									<option value="">Select Status</option>
									<option value="1" @if($category->is_active ==1) selected @endif>Active</option>
									<option value="0" @if($category->is_active ==0) selected @endif>Inactive</option>
								</select>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection