<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'deliveries';

    protected $fillable = ['user_id','status','reference','description','size','weight'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
