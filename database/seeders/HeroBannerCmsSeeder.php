<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\CMS\Repositories\PageRepository;

class HeroBannerCmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cmsRepository = app('Webkul\CMS\Repositories\PageRepository');

        // English Content
        $englishPages = [
            [
                'url_key'     => 'home-hero-title-en',
                'content'      => '<h1>Tradition Meets Excellence in Every Bite</h1>',
                'page_title'   => 'Home Hero Banner Title',
                'meta_title'   => '',
                'meta_description' => '',
                'meta_keywords' => '',
            ],
            [
                'url_key'     => 'home-hero-subtitle-en',
                'content'      => '<p>Discover Bangladesh\'s finest collection of authentic Bengali sweets, premium chocolates, and freshly baked treats made with pure saffron and love. Crafted using time-honored recipes passed down through generations.</p>',
                'page_title'   => 'Home Hero Banner Subtitle',
                'meta_title'   => '',
                'meta_description' => '',
                'meta_keywords' => '',
            ],
            [
                'url_key'     => 'home-hero-badge-en',
                'content'      => 'Welcome To Saffron Sweets & Bakery',
                'page_title'   => 'Home Hero Badge',
                'meta_title'   => '',
                'meta_description' => '',
                'meta_keywords' => '',
            ],
            [
                'url_key'     => 'home-hero-btn-primary-en',
                'content'      => 'Shop Now',
                'page_title'   => 'Home Hero Primary Button',
                'meta_title'   => '',
                'meta_description' => '',
                'meta_keywords' => '',
            ],
            [
                'url_key'     => 'home-hero-btn-secondary-en',
                'content'      => 'Our Story',
                'page_title'   => 'Home Hero Secondary Button',
                'meta_title'   => '',
                'meta_description' => '',
                'meta_keywords' => '',
            ],
        ];

        // Bangla Content
        $banglaPages = [
            [
                'url_key'     => 'home-hero-title-bn',
                'content'      => '<h1>প্রথমা মিলেছে উত্কর্মের সাথ প্রতিটি কামড়ে</h1>',
                'page_title'   => 'Home Hero Banner Title',
                'meta_title'   => '',
                'meta_description' => '',
                'meta_keywords' => '',
            ],
            [
                'url_key'     => 'home-hero-subtitle-bn',
                'content'      => '<p>বাংলাদেশের সেরা সংগ্রহের সূক্ষম সংগ্রহ, প্রিমিয়ম চকলেট এবং সতেয়ের তৈরি করা মিষ্টান, পিউর জাফরান এবং ভালোবা দিয়ে তৈরি। প্রজন্ম থেকে চলে আসা রেসিপি দিয়ে তৈরি।</p>',
                'page_title'   => 'Home Hero Banner Subtitle',
                'meta_title'   => '',
                'meta_description' => '',
                'meta_keywords' => '',
            ],
            [
                'url_key'     => 'home-hero-badge-bn',
                'content'      => 'স্বাফরন মিষ্টি অ্যান্ড বেকারিতে স্বাগতকর নামস্কাম',
                'page_title'   => 'Home Hero Badge',
                'meta_title'   => '',
                'meta_description' => '',
                'meta_keywords' => '',
            ],
            [
                'url_key'     => 'home-hero-btn-primary-bn',
                'content'      => 'এখনই কিনুন',
                'page_title'   => 'Home Hero Primary Button',
                'meta_title'   => '',
                'meta_description' => '',
                'meta_keywords' => '',
            ],
            [
                'url_key'     => 'home-hero-btn-secondary-bn',
                'content'      => 'আমাদের গল্প',
                'page_title'   => 'Home Hero Secondary Button',
                'meta_title'   => '',
                'meta_description' => '',
                'meta_keywords' => '',
            ],
        ];

        // Insert or update English pages
        foreach ($englishPages as $page) {
            $existing = $cmsRepository->findOneByField('url_key', $page['url_key']);

            if ($existing) {
                $cmsRepository->update($existing->id, $page);
            } else {
                $cmsRepository->create($page);
            }
        }

        // Insert or update Bangla pages
        foreach ($banglaPages as $page) {
            $existing = $cmsRepository->findOneByField('url_key', $page['url_key']);

            if ($existing) {
                $cmsRepository->update($existing->id, $page);
            } else {
                $cmsRepository->create($page);
            }
        }

        $this->command->info('Hero Banner CMS pages seeded successfully!');
    }
}