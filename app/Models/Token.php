<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{    
    public $timestamps = false;
    protected $connection ='mysql';
    protected $guarded = ['id'];
    protected $table = 'tokens';
    protected $primaryKey = 'id';
    protected $fillable = ['name','description','token'];
    protected $hidden = [];
    protected $dates = ['created_at'];
}