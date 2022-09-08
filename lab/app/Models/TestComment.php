<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestComment extends Model
{
    public $guarded=[];

    public function test()
    {
        return $this->belongsTo(Test::class,'test_id','id');
    }

    // relation with test_comment_component
    public function components()
    {
        return $this->hasMany(CommentComponent::class,'comment_id','id');
    }
}
