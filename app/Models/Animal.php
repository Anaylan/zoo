<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $species
 * @property string $name
 * @property integer $age
 * @property string $description
 * @property integer $cage_id
 */
class Animal extends Model
{
    /** @use HasFactory<\Database\Factories\AnimalFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'species',
        'name',
        'age',
        'description',
        'cage_id'
    ];

    protected function casts(): array
    {
        return [
            'cage_id' => 'integer'
        ];
    }

    public function cage(): BelongsTo
    {
        return $this->belongsTo(Cage::class, 'cage_id', 'id');
    }
}
