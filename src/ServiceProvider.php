<?php

namespace WebduoNederland\LaravelMissingTranslations;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Translation\Translator;
use WebduoNederland\LaravelMissingTranslations\Actions\HandleMissingTranslationAction;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this
            ->bootMigrations()
            ->bootMissingKeyHandler();
    }

    protected function bootMigrations(): self
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        return $this;
    }

    protected function bootMissingKeyHandler(): self
    {
        $this->app->extend('translator', function (Translator $translator): Translator {
            /** @var HandleMissingTranslationAction $handleMissingTranslationAction */
            $handleMissingTranslationAction = app(HandleMissingTranslationAction::class);

            $translator->handleMissingKeysUsing($handleMissingTranslationAction);

            return $translator;
        });

        return $this;
    }
}
