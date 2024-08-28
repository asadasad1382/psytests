<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserChoice extends Model
{
    use HasFactory;

    protected $table = 'user_choice';
    protected $guarded = ['id'];

    public function question(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Question::class, 'id', 'question_id');
    }

    public function isCorrect(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->question?->answer === $this->answer
        );
    }
}
