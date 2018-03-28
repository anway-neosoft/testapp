@extends ('layouts.dashboard')
@section('page_heading',ucwords($record->title))

@section('section')


<div class="col-sm-12">
	<div class="form-group col-sm-12">
		<label class="col-sm-4 control-label">Title</label>
		<div class="col-sm-8">{{ucwords($record->title)}}</div>
	</div>
	<div class="form-group col-sm-12">
		<label class="col-sm-4 control-label">Description</label>
		<div class="col-sm-8">{{ucwords($record->description)}}</div>
	</div>
	<div class="form-group col-sm-12">
		<label class="col-sm-4 control-label">Parent Category</label>
		<div class="col-sm-8">{{$record->parent()->first()?ucwords($record->parent()->first()->title):'NA'}}</div>
	</div>
	<div class="form-group col-sm-12">
	<button class="btn btn-default" onclick="back()">Back</button>
	</div>

</div>
<script>
function back(){
	window.location = '{{url("/categories")}}';
}
</script>
@stop