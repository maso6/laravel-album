<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokenGalleries extends Model
{    
    public $timestamps = false;
    protected $connection ='mysql';
    protected $guarded = ['id'];
    protected $table = 'token_galleries';
    protected $primaryKey = 'id';
    protected $fillable = ['token_id','gallery_id'];
    protected $hidden = [];
    protected $dates = [];
}