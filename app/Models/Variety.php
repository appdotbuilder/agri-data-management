<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Variety
 *
 * @property int $id
 * @property int $commodity_id
 * @property string $name
 * @property int|null $release_year
 * @property float|null $potential_yield
 * @property float|null $average_yield
 * @property int|null $maturity_days
 * @property int|null $plant_height
 * @property string|null $seed_color
 * @property float|null $seed_weight
 * @property float|null $protein_content
 * @property float|null $fat_content
 * @property string|null $breeder
 * @property string|null $proposer
 * @property string|null $image_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Commodity $commodity
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pest> $pests
 * @property-read int|null $pests_count
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Variety newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variety newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Variety query()
 * @method static \Illuminate\Database\Eloquent\Builder|Variety whereAverageYield($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety whereBreeder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety whereCommodityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety whereFatContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety whereMaturityDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety wherePlantHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety wherePotentialYield($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety whereProposer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety whereProteinContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety whereReleaseYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety whereSeedColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety whereSeedWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Variety whereUpdatedAt($value)
 * @method static \Database\Factories\VarietyFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Variety extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'commodity_id',
        'name',
        'release_year',
        'potential_yield',
        'average_yield',
        'maturity_days',
        'plant_height',
        'seed_color',
        'seed_weight',
        'protein_content',
        'fat_content',
        'breeder',
        'proposer',
        'image_path',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'potential_yield' => 'decimal:2',
        'average_yield' => 'decimal:2',
        'seed_weight' => 'decimal:2',
        'protein_content' => 'decimal:2',
        'fat_content' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the commodity that owns the variety.
     */
    public function commodity(): BelongsTo
    {
        return $this->belongsTo(Commodity::class);
    }

    /**
     * Get the pests that affect this variety.
     */
    public function pests(): BelongsToMany
    {
        return $this->belongsToMany(Pest::class)
            ->withPivot('susceptibility')
            ->withTimestamps();
    }
}