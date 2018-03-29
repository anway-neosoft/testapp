<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
    //
   	//use SoftDeletes;
   	protected $guarded = [];
   	protected $hidden=['created_at','updated_at','deleted_at','created_by','updated_by'];

   	public function parent(){
   		return $this->belongsTo(Category::class,'parent_id');
   	}

   	public function children(){
   		return $this->hasMany(Category::class,'parent_id');
   	}

   	public function getListing($filter=[]){
   		return $this->paginate(config('globals.PAGINATION_LIMIT'));
   	}

   	public function getDropDownList($exceptId=''){
   		$q = $this;
   		if($exceptId){
   			$q = $q->where('id','!=',$exceptId);
   		}

   		return $q->pluck('title','id')->toArray();
   	}

   	public function saveRecord($data,$id=''){
   		$user = \Auth::getUser()->id;
   		$record = '';
   		if($id){
   			$record = $this->find($id);
   		}
   		if($record){
   			$data['updated_by'] = $user;
   			$result = $record->update($data);
   		}else{
   			$data['created_by'] = $user;
   			$data['updated_by'] = $user;
   			$result = $this->create($data);
   		}
   		return $result;
   	}
}
