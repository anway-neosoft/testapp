@extends ('layouts.dashboard')
@section('page_heading',' Add User')

@section('section')
<div class="col-sm-12">
<div class="row">
    <div class="col-lg-6">
{!! Form::open(['url'=>url('users'),'method'=>'POST','onsubmit'=>'return validate()'])!!}
    <div class="form-group">
       {!! Form::label('name','Enter User Name')!!}
       {!! Form::text('name',null,['id'=>'name','class'=>'form-control'])!!}
        <p class="alert-danger">{{$errors->first('name')}}</p>
    </div>
    <div class="form-group">
        {!! Form::label('email','Enter User Email')!!}
       {!! Form::text('email',null,['id'=>'email','class'=>'form-control'])!!}
        <p class="alert-danger">{{$errors->first('email')}}</p>
    </div>
    <div class="form-group">
       {!! Form::label('password','Enter Password')!!}
       {!! Form::password('password',null,['id'=>'password','class'=>'form-control'])!!}
        <p class="alert-danger">{{$errors->first('password')}}</p>
    </div>
    <div class="form-group">
       {!! Form::label('re-pass',' Re-Enter Password')!!}
       {!! Form::password('re-pass',null,['id'=>'re-pass','class'=>'form-control'])!!}
        <p class="alert-danger">{{$errors->first('re-pass')}}</p>
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
  if(result){
    if($('#password').val()!= $('#re-pass').val()){
      $('#re-pass').closest('p').html('Password do not match');
      result =false;
    }
  }

  return result;
}
</script>
@stop