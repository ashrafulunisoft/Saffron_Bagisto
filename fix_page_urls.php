<?php

/**
 * Fix Page URLs Script
 * This script updates all URLs in theme_customization_translations table
 * from http://localhost/public/ to http://localhost:8000/
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Starting URL fix process...\n";

// Get all theme customization translations
$translations = DB::table('theme_customization_translations')->get();

$updatedCount = 0;

foreach ($translations as $translation) {
    $options = json_decode($translation->options, true);
    $updated = false;

    // Check and update URLs in column_1
    if (isset($options['column_1'])) {
        foreach ($options['column_1'] as &$link) {
            if (isset($link['url']) && strpos($link['url'], 'http://localhost/public/') === 0) {
                $link['url'] = str_replace('http://localhost/public/', 'http://localhost:8000/', $link['url']);
                $updated = true;
            }
        }
    }

    // Check and update URLs in column_2
    if (isset($options['column_2'])) {
        foreach ($options['column_2'] as &$link) {
            if (isset($link['url']) && strpos($link['url'], 'http://localhost/public/') === 0) {
                $link['url'] = str_replace('http://localhost/public/', 'http://localhost:8000/', $link['url']);
                $updated = true;
            }
        }
    }

    // If any URLs were updated, save back to database
    if ($updated) {
        DB::table('theme_customization_translations')
            ->where('id', $translation->id)
            ->update(['options' => json_encode($options)]);
        $updatedCount++;
        echo "Updated translation ID: {$translation->id}\n";
    }
}

echo "\nURL fix process completed!\n";
echo "Total translations updated: {$updatedCount}\n";
