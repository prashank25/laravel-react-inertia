<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

/**
 * @property string $id
 * @property string $name
 * @property string $slug
 */
final class Team extends Model
{
    /** @use HasFactory<\Database\Factories\TeamFactory> */
    use HasFactory;

    use HasUlids;

    /** @return HasMany<User, $this> */
    public function members(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /** @return HasOne<User, $this> */
    public function owner(): HasOne
    {
        return $this->hasOne(User::class)->where('owner', true);
    }

    protected static function booted(): void
    {
        self::creating(function (Team $team): void {
            if (empty($team->slug)) {
                $team->slug = Str::slug($team->name);

                $originalSlug = $team->slug;
                $count = 1;
                while (self::query()->where('slug', $team->slug)->exists()) {
                    $team->slug = $originalSlug.'-'.$count++;
                }
            }
        });
    }
}
