@extends('layouts.app')
@section('title', 'Products Lists')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  	<div class="container-fluid">
    	<div class="row mb-2">
      		<div class="col-sm-6">
        		<h1>Products Lists</h1>
      		</div>
      		<div class="col-sm-6">
        		<ol class="breadcrumb float-sm-right">
          			<li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          			<li class="breadcrumb-item active">Products Lists</li>
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
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Products Lists</h3>
						<a href="{{ url('/product/create') }}" class="btn btn-primary btn-lg" style="float: right"><i class="fa fa-plus" aria-hidden="true"></i> Add Product</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						@if ($message = Session::get('success'))
					        <div class="alert alert-success">
					            <p>{{ $message }}</p>
					        </div>
					    @endif

					    <?php //if(isset($subcategories)){ ?>
						<table class="table table-bordered">
							<thead>                  
								<tr>
									<th style="width: 10px">#</th>
									<th>Category Name</th>
									<th>Subcategory Name</th>
									<th>Product Name</th>
									<th>Product Image</th>
									<th>Status</th>
									<th style="width: 50px">Action</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
						<?php //} ?>
					</div>
					<!-- /.card-body -->
					<div class="card-footer clearfix">
						<div class="pagination pagination-sm m-0 float-right">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
