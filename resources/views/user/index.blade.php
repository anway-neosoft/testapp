@extends ('layouts.dashboard')
@section('page_heading',' Users')

@section('section')
@if(Session::has('message'))
<div class="col-sm-12 form-group"><p class="alert alert-{{Session::get('class')}}">{{Session::get('message')}}</p></div>
@endif
<div class="form-group col-sm-12">
<a class="btn btn-primary pull-right" href="{{url('/users/create')}}">Add User</a>
</div>
<div class="clearfix"></div>

<div class="col-sm-12">
		@if($data->count())
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php $count = intval($data->currentPage()-1)*config('globals.PAGINATION_LIMIT'); ?>
				@foreach($data as $row)
				<tr class="">
					<td>{{++$count}}
					<td>{{$row->name}}</td>
					<td>{{$row->email}}</td>
					<td>
					{!! Form::open(['route'=>['users.destroy',$row->id],'method'=>'DELETE','id'=>'deleteUser'.$row->id])!!}
					{!! Form::close()!!}
					<a class="btn btn-primary" href="{{url('/users/'.$row->id.'/edit')}}">Edit</a>
					<a class="btn btn-primary" href="{{url('/users/'.$row->id)}}">View</a>
					<a class="btn btn-primary" href="javascript:void(0)" onclick="delUser({{$row->id}})">Delete</a>

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
function delUser(id){
	if(confirm('Do you want to delete this user?')){
		$('#deleteUser'+id).submit();
	}
}
</script>
@stop