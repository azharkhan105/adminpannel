@extends('layouts.app')
@section('title', 'Subcategory Add')
@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Add Subcategory</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
					<li class="breadcrumb-item active">Add Subcategory</li>
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
						<h3 class="card-title">Add Subcategory</h3>
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
					<form role="form" method="post" action="{{ route('subcategory.store') }}" enctype="multipart/form-data">
					@csrf
						<div class="card-body">
							<div class="form-group">
								<label for="category_id">Category Name</label>
								<select name="category_id" id="category_id" class="form-control">
									<option value="">Select Category</option>
									@foreach($category as $cat)
									<option value="{{ $cat->id }}">{{ $cat->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label for="subcategory_name">Subcategory Name</label>
								<input type="text" class="form-control" id="subcategory_name" placeholder="Subcategory Name" name="subcategory_name">
							</div>

							<div class="form-group">
			                    <label for="exampleInputFile">Subcategory Image</label>
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
									<option value="1">Active</option>
									<option value="0">Inactive</option>
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