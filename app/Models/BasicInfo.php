<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicInfo extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected $table = 'basic_info';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
