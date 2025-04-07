<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $title
 * @property integer $capacity
 */
class Cage extends Model
{
    /** @use HasFactory<\Database\Factories\CageFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'capacity'
    ];


    protected function casts(): array
    {
        return [
            'capacity' => 'integer'
        ];
    }

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
}
