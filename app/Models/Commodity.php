<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Commodity
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Variety> $varieties
 * @property-read int|null $varieties_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pest> $pests
 * @property-read int|null $pests_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CommodityRecommendation> $recommendations
 * @property-read int|null $recommendations_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Commodity whereUpdatedAt($value)
 * @method static \Database\Factories\CommodityFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Commodity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
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
     * Get the varieties for the commodity.
     */
    public function varieties(): HasMany
    {
        return $this->hasMany(Variety::class);
    }

    /**
     * Get the pests that affect this commodity.
     */
    public function pests(): BelongsToMany
    {
        return $this->belongsToMany(Pest::class)
            ->withPivot('is_endemic')
            ->withTimestamps();
    }

    /**
     * Get the recommendations for the commodity.
     */
    public function recommendations(): HasMany
    {
        return $this->hasMany(CommodityRecommendation::class);
    }
}