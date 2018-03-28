@extends ('layouts.dashboard')
@section('page_heading',' Edit User')

@section('section')
<div class="col-sm-12">
<div class="row">
    <div class="col-lg-6">
{!! Form::open(['route'=>['users.update',$record->id],'method'=>'PUT','onsubmit'=>'return validate()'])!!}
    <div class="form-group">
       {!! Form::label('name','Enter User Name')!!}
       {!! Form::text('name',$record->name,['id'=>'name','class'=>'form-control'])!!}
        <p class="alert-danger">{{$errors->first('name')}}</p>
    </div>
    <div class="form-group">
        {!! Form::label('email','Enter User Email')!!}
       {!! Form::text('email',$record->email,['id'=>'email','class'=>'form-control'])!!}
        <p class="alert-danger">{{$errors->first('email')}}</p>
    </div>
   
    
    {!! Form::submit('Submit',['class'=>'btn btn-primary'])!!}
    {!! Form::button('Cancel',['class'=>'btn btn-default','onClick'=>'redirectBack()'])!!}
   
{!! Form::close()!!}
</div>
</div>
</div>
<script>
function redirectBack(){
    window.location = "{{url('users')}}";
}

function validate(){
  var result =true;
  $('input').each(function(){
    if(!$(this).val()){
      $(this).closest('p').html('This field cannot be kept blank');
      result =false;
    }
  });

  return result;
}
</script>
@stop