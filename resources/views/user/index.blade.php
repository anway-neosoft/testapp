@extends ('layouts.dashboard')
@section('page_heading',' Categories')

@section('section')
@if(Session::has('message'))
<div class="col-sm-12 form-group"><p class="alert alert-{{Session::get('class')}}">{{Session::get('message')}}</p></div>
@endif
<div class="form-group col-sm-12">
<a class="btn btn-primary pull-right" href="{{url('/categories/create')}}">Add Category</a>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
		@if($data->count())
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Description</th>
					<th>Parent Category</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php $count = intval($data->currentPage()-1)*config('globals.PAGINATION_LIMIT'); ?>
				@foreach($data as $row)
				<tr class="">
					<td>{{++$count}}
					<td>{{$row->title}}</td>
					<td>{{$row->description}}</td>
					<td>{{$row->parent()->first()?$row->parent()->first()->title:''}}</td>
					<td>
					{!! Form::open(['route'=>['categories.destroy',$row->id],'method'=>'DELETE','id'=>'deleteCat'.$row->id])!!}
					{!! Form::close()!!}
					<a class="btn btn-primary" href="{{url('/categories/'.$row->id.'/edit')}}">Edit</a>
					<a class="btn btn-primary" href="{{url('/categories/'.$row->id)}}">View</a>
					<a class="btn btn-primary" href="javascript:void(0)" onclick="delCat({{$row->id}})">Delete</a>

					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="pagination">
		{{$data->render()}}
		</div>	
		@else
		<div class="alert alert-info">No Data Found</div>
		@endif
	</div>
<script>
function delCat(id){
	if(confirm('Do you want to delete this category')){
		$('#deleteCat'+id).submit();
	}
}
</script>
@stop