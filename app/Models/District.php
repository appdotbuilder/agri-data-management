<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\District
 *
 * @property int $id
 * @property int $regency_id
 * @property string $name
 * @property float|null $latitude
 * @property float|null $longitude
 * @property float|null $cropping_index
 * @property int|null $rainy_months
 * @property float|null $k_nutrient
 * @property float|null $p_nutrient
 * @property float|null $c_nutrient
 * @property float|null $cation_exchange_capacity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Regency $regency
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PestDetection> $pestDetections
 * @property-read int|null $pest_detections_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CommodityRecommendation> $commodityRecommendations
 * @property-read int|null $commodity_recommendations_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|District query()
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCationExchangeCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCNutrient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereCroppingIndex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereKNutrient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District wherePNutrient($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereRainyMonths($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereRegencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|District whereUpdatedAt($value)
 * @method static \Database\Factories\DistrictFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class District extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'regency_id',
        'name',
        'latitude',
        'longitude',
        'cropping_index',
        'rainy_months',
        'k_nutrient',
        'p_nutrient',
        'c_nutrient',
        'cation_exchange_capacity',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'cropping_index' => 'decimal:2',
        'k_nutrient' => 'decimal:2',
        'p_nutrient' => 'decimal:2',
        'c_nutrient' => 'decimal:2',
        'cation_exchange_capacity' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the regency that owns the district.
     */
    public function regency(): BelongsTo
    {
        return $this->belongsTo(Regency::class);
    }

    /**
     * Get the users for the district.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the pest detections for the district.
     */
    public function pestDetections(): HasMany
    {
        return $this->hasMany(PestDetection::class);
    }

    /**
     * Get the commodity recommendations for the district.
     */
    public function commodityRecommendations(): HasMany
    {
        return $this->hasMany(CommodityRecommendation::class);
    }
}