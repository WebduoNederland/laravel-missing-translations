<?php

namespace WebduoNederland\LaravelMissingTranslations\Actions;

use WebduoNederland\LaravelMissingTranslations\Models\MissingTranslation;

class HandleMissingTranslationAction
{
    public function __invoke(string $key, array $replace, ?string $locale, bool $fallback): void
    {
        if (in_array($locale, config()->array('laravel-missing-translations.exclude_locales'))) {
            return;
        }

        if (in_array($key, config()->array('laravel-missing-translations.exclude_translations'))) {
            return;
        }

        $missingTranslation = MissingTranslation::query()
            ->where('key', '=', $key)
            ->first();

        if ($missingTranslation === null) {
            MissingTranslation::query()
                ->create([
                    'key' => $key,
                    'locale' => $locale,
                    'first_occurrence' => now(),
                    'last_occurrence' => now(),
                ]);

            return;
        }

        $missingTranslation->update([
            'total_occurrences' => $missingTranslation->total_occurrences + 1,
            'last_occurrence' => now(),
        ]);
    }
}
