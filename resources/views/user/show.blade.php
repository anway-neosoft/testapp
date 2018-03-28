@extends ('layouts.dashboard')
@section('page_heading',ucwords($record->name))

@section('section')


<div class="col-sm-12">
	<div class="form-group col-sm-12">
		<label class="col-sm-4 control-label">Name</label>
		<div class="col-sm-8">{{ucwords($record->name)}}</div>
	</div>
	<div class="form-group col-sm-12">
		<label class="col-sm-4 control-label">Email</label>
		<div class="col-sm-8">{{$record->email}}</div>
	</div>

	<div class="form-group col-sm-12">
	<button class="btn btn-default" onclick="back()">Back</button>
	</div>

</div>
<script>
function back(){
	window.location = '{{url("/users")}}';
}
</script>
@stop