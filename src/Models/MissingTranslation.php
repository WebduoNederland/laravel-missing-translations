<?php

namespace WebduoNederland\LaravelMissingTranslations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $key
 * @property ?string $locale
 * @property array $replace_data
 * @property int $total_occurrences
 * @property Carbon $first_occurrence
 * @property Carbon $last_occurrence
 */
class MissingTranslation extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'replace_data' => 'array',
            'first_occurrence' => 'datetime',
            'last_occurrence' => 'datetime',
        ];
    }
}
