<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Distrik extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'luas_tanam',
        'luas_panen',
        'produksi',
        'produktivitas',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function lahan(): HasMany
    {
        return $this->hasMany(Distrik::class);
    }

    /**
     * Get the gapoktan users assigned to this distrik.
     */
    public function gapoktan(): HasMany
    {
        return $this->hasMany(User::class, 'distrik_id');
    }
}
