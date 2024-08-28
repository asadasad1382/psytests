<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function test(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Test::class, 'id', 'test_id');
    }
}
