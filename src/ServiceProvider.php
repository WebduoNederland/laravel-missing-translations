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
            ->bootConfig()
            ->bootMigrations()
            ->bootMissingKeyHandler();
    }

    protected function bootConfig(): self
    {
        if (! $this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravel-missing-translations.php' => config_path('laravel-missing-translations.php'),
            ], 'config');
        }

        return $this;
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

    public function register(): void
    {
        $this
            ->registerConfig();
    }

    protected function registerConfig(): self
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-missing-translations.php', 'laravel-missing-translations');

        return $this;
    }
}
