<?php

return [
    /**
     * Enabling this will skip missing translations that start with "validation."
     * Setting this to false will trigger many missing translations for each validation field that does not have its own translation.
     *
     * Default: true
     */
    'skip_validation_translations' => true,

    /**
     * An array of missing translations that you do not want to save.
     */
    'exclude_translations' => [
        // Example: 'Server Error'
    ],

    /**
     * An array of locales you do not want to save missing translations from.
     */
    'exclude_locales' => [
        // Example: 'en'
    ],
];
