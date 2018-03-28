@extends ('layouts.dashboard')
@section('page_heading',' Add Category')

@section('section')
<div class="col-sm-12">
<div class="row">
    <div class="col-lg-6">
{!! Form::open(['route'=>['categories.update',$record->id],'method'=>'PUT'])!!}
    <div class="form-group">
       {!! Form::label('title','Enter Category Title')!!}
       {!! Form::text('title',$record->title,['id'=>'title','class'=>'form-control'])!!}
        <p class="alert-danger">{{$errors->first('title')}}</p>
    </div>
    <div class="form-group">
        {!! Form::label('description','Enter Category Description')!!}
       {!! Form::textarea('description',$record->description,['id'=>'description','class'=>'form-control','rows'=>5,'cols'=>30])!!}
        <p class="alert-danger">{{$errors->first('description')}}</p>
    </div>
    <div class="form-group">
       {!! Form::label('parent_id','Enter Category parent_id')!!}
       {!! Form::select('parent_id',$categories,$record->parent_id,['id'=>'parent_id','class'=>'form-control'])!!}
        <p class="alert-danger">{{$errors->first('parent_id')}}</p>
    </div>
   
    
   
    {!! Form::submit('Update',['class'=>'btn btn-primary'])!!}
    {!! Form::button('Cancel',['class'=>'btn btn-default','onClick'=>'redirectBack()'])!!}
   
{!! Form::close()!!}
</div>
</div>
</div>
<script>
function redirectBack(){
    window.location = "{{url('categories')}}";
}
</script>
@stop