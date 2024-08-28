<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function get($key)
    {
        $setting = Setting::where('key', $key)->first();
        return $setting ? $setting->value : '';
    }

    public static function set($key, $value)
    {
        $setting = Setting::where('key', $key)->first();
        if ($setting) {
            $setting->update([
                'key' => $key,
                'value' => $value
            ]);
        } else {
            Setting::where('key', $key)->create([
                'key' => $key,
                'value' => $value
            ]);
        }
    }
}
