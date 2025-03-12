<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{    
    public $timestamps = false;
    protected $connection ='mysql';
    protected $guarded = ['id'];
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = ['description','image','gallery_id'];
    protected $hidden = [];
    protected $dates = ['created_at'];
}