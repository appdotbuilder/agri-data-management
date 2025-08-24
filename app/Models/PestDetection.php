<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\PestDetection
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $district_id
 * @property int|null $predicted_pest_id
 * @property int|null $verified_pest_id
 * @property string $image_path
 * @property float|null $latitude
 * @property float|null $longitude
 * @property float|null $confidence_score
 * @property string $status
 * @property string|null $notes
 * @property int|null $verified_by
 * @property \Illuminate\Support\Carbon|null $verified_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\District|null $district
 * @property-read \App\Models\Pest|null $predictedPest
 * @property-read \App\Models\Pest|null $verifiedPest
 * @property-read \App\Models\User|null $verifier
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection query()
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection whereConfidenceScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection wherePredictedPestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection whereVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection whereVerifiedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PestDetection whereVerifiedPestId($value)
 * @method static \Database\Factories\PestDetectionFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class PestDetection extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'district_id',
        'predicted_pest_id',
        'verified_pest_id',
        'image_path',
        'latitude',
        'longitude',
        'confidence_score',
        'status',
        'notes',
        'verified_by',
        'verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'confidence_score' => 'decimal:4',
        'verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that created the detection.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the district where the detection was made.
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Get the pest predicted by AI.
     */
    public function predictedPest(): BelongsTo
    {
        return $this->belongsTo(Pest::class, 'predicted_pest_id');
    }

    /**
     * Get the pest verified by expert.
     */
    public function verifiedPest(): BelongsTo
    {
        return $this->belongsTo(Pest::class, 'verified_pest_id');
    }

    /**
     * Get the user who verified the detection.
     */
    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}