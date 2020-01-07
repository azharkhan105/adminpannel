@extends('layouts.app')
@section('title', 'Product Edit')
@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Edit Product</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
					<li class="breadcrumb-item active">Edit Product</li>
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
						<h3 class="card-title">Edit Product</h3>
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
					<form role="form" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
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
								<select name="subcategory_id" id="subcategory_id" class="form-control">
									<option value="">Select Subcategory</option>
									@foreach($subcategory as $sub)
									<option value="{{ $sub->id }}">{{ $sub->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label for="product_name">Product Name</label>
								<input type="text" class="form-control" id="product_name" placeholder="Product Name" name="product_name">
							</div>

							<div class="form-group">
								<label for="sku">Sku</label>
								<input type="text" class="form-control" id="sku" placeholder="Sku" name="sku">
							</div>

							<div class="form-group">
								<label for="price">Price</label>
								<input type="text" class="form-control" id="price" placeholder="Price" name="price">
							</div>

							<div class="form-group">
			                    <label for="exampleInputFile">Product Image</label>
			                    <div class="input-group">
			                      	<div class="custom-file">
			                        	<input type="file" class="custom-file-input" id="exampleInputFile" name="image[]" multiple>
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