<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    use HasFactory;

    protected $table = 'user_test';
    protected $guarded = ['id'];

    public function choices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserChoice::class, 'user_test_id', 'id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }


    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }

    public function test(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Test::class, 'id', 'test_id');
    }
}
