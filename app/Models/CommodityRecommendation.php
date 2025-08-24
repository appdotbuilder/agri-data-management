<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\CommodityRecommendation
 *
 * @property int $id
 * @property int $district_id
 * @property int $commodity_id
 * @property float|null $productivity
 * @property float|null $improvement_potential
 * @property float|null $potential_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\District $district
 * @property-read \App\Models\Commodity $commodity
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|CommodityRecommendation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommodityRecommendation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommodityRecommendation query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommodityRecommendation whereCommodityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommodityRecommendation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommodityRecommendation whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommodityRecommendation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommodityRecommendation whereImprovementPotential($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommodityRecommendation wherePotentialValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommodityRecommendation whereProductivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommodityRecommendation whereUpdatedAt($value)
 * @method static \Database\Factories\CommodityRecommendationFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class CommodityRecommendation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'district_id',
        'commodity_id',
        'productivity',
        'improvement_potential',
        'potential_value',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'productivity' => 'decimal:2',
        'improvement_potential' => 'decimal:2',
        'potential_value' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the district that owns the recommendation.
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get the commodity that owns the recommendation.
     */
    public function commodity(): BelongsTo
    {
        return $this->belongsTo(Commodity::class);
    }
}