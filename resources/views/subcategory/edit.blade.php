@extends('layouts.app')
@section('title', 'Subcategory Edit')
@section('content')
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>Edit Subcategory</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
					<li class="breadcrumb-item active">Edit Subcategory</li>
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
						<h3 class="card-title">Edit Subcategory</h3>
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
					<form role="form" method="post" action="{{ route('subcategory.update', $subcategory->id) }}">
					@csrf
					@method('PUT')
						<div class="card-body">
							<div class="form-group">
								<label for="category_id">Category Name</label>
								<select name="category_id" id="category_id" class="form-control">
									<option value="">Select Category</option>
									@foreach($category as $cat)
									<option value="{{ $cat->id }}" @if($cat->id == $subcategory->category_id) selected @endif>{{ $cat->name }}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label for="subcategory_name">Subcategory Name</label>
								<input type="text" class="form-control" id="subcategory_name" placeholder="Subcategory Name" name="subcategory_name" value="{{ $subcategory->name }}">
							</div>
							<div class="form-group">
								<label for="status">Status</label>
								<select name="status" id="status" class="form-control">
									<option value="">Select Status</option>
									<option value="1" @if($subcategory->is_active ==1) selected @endif>Active</option>
									<option value="0" @if($subcategory->is_active ==0) selected @endif>Inactive</option>
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