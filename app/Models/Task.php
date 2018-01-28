<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Task extends Model
{
   use SoftDeletes;

	public $table = 'tasks';
	protected $fillable = ['name','due','list','inquiry_id','user_id','notes','status'];
}
