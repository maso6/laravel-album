<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{    
    public $timestamps = false;
    protected $connection ='mysql';
    protected $guarded = ['id'];
    protected $table = 'galleries';
    protected $primaryKey = 'id';
    protected $fillable = ['title','description','image'];
    protected $hidden = [];
    protected $dates = ['created_at'];
}
