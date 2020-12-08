<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value'];

    public static function get($key)
    {
        $setting = new self();
        $entry = $setting->where('key', $key)->first();
        if (!$entry) {
            return;
        }
        return $entry->value;
    }

    public static function set($key, $value = null)
    {
        $setting = new self();
        $entry = $setting->where('key', $key)->firstOrFail();
        $entry->value = $value;
        $entry->saveOrFail();

        config()->set('key', $value);
        
        if (config()->get($key) == $value) {
            return true;
        }

        return false;
    }
}
