<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organization extends Model
{
    use HasFactory;

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
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(OrganizationUser::class);
    }
}
