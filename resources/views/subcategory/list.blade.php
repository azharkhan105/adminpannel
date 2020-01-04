@extends('layouts.app')
@section('title', 'Subcategory Lists')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  	<div class="container-fluid">
    	<div class="row mb-2">
      		<div class="col-sm-6">
        		<h1>Subcategory Lists</h1>
      		</div>
      		<div class="col-sm-6">
        		<ol class="breadcrumb float-sm-right">
          			<li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          			<li class="breadcrumb-item active">Subcategory Lists</li>
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
						<h3 class="card-title">Subcategory Lists</h3>
						<a href="{{ url('/subcategory/create') }}" class="btn btn-primary btn-lg" style="float: right"><i class="fa fa-plus" aria-hidden="true"></i> Add Subcategory</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						@if ($message = Session::get('success'))
					        <div class="alert alert-success">
					            <p>{{ $message }}</p>
					        </div>
					    @endif

					    <?php if(isset($subcategories)){ ?>
						<table class="table table-bordered">
							<thead>                  
								<tr>
									<th style="width: 10px">#</th>
									<th>Category Name</th>
									<th>Subcategory Name</th>
									<th>Status</th>
									<th style="width: 150px">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($subcategories as $subcat)
								<tr>
									<td>{{ ++$i }}</td>
									<td>{{ $subcat->cat_name }}</td>
									<td>{{ $subcat->name }}</td>
									<td>@if($subcat->is_active == 1) Active @else Inactive @endif</td>
									<td>
										<form action="{{ route('subcategory.destroy',$subcat->id) }}" method="POST">
										<a href="{{ route('subcategory.edit', $subcat->id) }}"><button type="button" class="btn btn-success"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
										
										@csrf
                    					@method('DELETE')
                    					<button type="submit" class="btn btn-danger" onclick= "if(confirm('Are you sure you want to delete this record ?')){ return true; }else {return false;}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    					</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<?php } ?>
					</div>
					<!-- /.card-body -->
					<div class="card-footer clearfix">
						<div class="pagination pagination-sm m-0 float-right">
							{!! $subcategories->links() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
