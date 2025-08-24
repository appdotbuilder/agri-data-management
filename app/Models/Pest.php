<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Pest
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string|null $target_plants
 * @property string|null $symptoms
 * @property string|null $cultural_control
 * @property string|null $physical_control
 * @property string|null $chemical_control
 * @property string|null $biological_control
 * @property string|null $image_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Variety> $varieties
 * @property-read int|null $varieties_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Commodity> $commodities
 * @property-read int|null $commodities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PestDetection> $detections
 * @property-read int|null $detections_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Pest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pest query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pest whereBiologicalControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pest whereChemicalControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pest whereCulturalControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pest whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pest wherePhysicalControl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pest whereSymptoms($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pest whereTargetPlants($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pest whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pest whereUpdatedAt($value)
 * @method static \Database\Factories\PestFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Pest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'type',
        'target_plants',
        'symptoms',
        'cultural_control',
        'physical_control',
        'chemical_control',
        'biological_control',
        'image_path',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the varieties that are susceptible to this pest.
     */
    public function varieties(): BelongsToMany
    {
        return $this->belongsToMany(Variety::class)
            ->withPivot('susceptibility')
            ->withTimestamps();
    }

    /**
     * Get the commodities that are affected by this pest.
     */
    public function commodities(): BelongsToMany
    {
        return $this->belongsToMany(Commodity::class)
            ->withPivot('is_endemic')
            ->withTimestamps();
    }

    /**
     * Get the detections for this pest.
     */
    public function detections(): HasMany
    {
        return $this->hasMany(PestDetection::class, 'predicted_pest_id');
    }
}