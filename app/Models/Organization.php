<?php

namespace App\Models;

use App\Enums\OrganizationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $created_by
 * @property User $createdBy
 */
class Organization extends Model
{
    use HasFactory;

    public static function boot(): void
    {
        parent::boot();
        if (auth()->user()) {
            static::saving(function ($model) {
                $model->created_by = auth()->id();
            });
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ein', // Employer Identification Number (EIN) is the brazillian CNPJ.
        'name',
        'email',
        'url',
        'status',
        'active',
        'created_by',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => OrganizationStatus::class,
        ];
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(OrganizationUser::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsToMany(User::class)->using(OrganizationUser::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
