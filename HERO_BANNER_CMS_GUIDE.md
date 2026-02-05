# Hero Banner CMS Content Setup Guide

This guide explains how to set up admin-editable CMS content for the Hero Banner section on the homepage.

## Overview

The Hero Banner section now supports dynamic content that can be edited from the Admin panel in both English and Bangla languages.

## Required CMS Pages

Create the following 10 CMS pages in the Admin panel:

### English Content (5 pages)

1. **Home Hero Title (English)**
   - URL Key: `home-hero-title-en`
   - Content: `Tradition Meets Excellence in Every Bite`
   - Page Title: Home Hero Banner Title

2. **Home Hero Subtitle (English)**
   - URL Key: `home-hero-subtitle-en`
   - Content: `Discover Bangladesh's finest collection of authentic Bengali sweets, premium chocolates, and freshly baked treats made with pure saffron and love. Crafted using time-honored recipes passed down through generations.`
   - Page Title: Home Hero Banner Subtitle

3. **Home Hero Badge (English)**
   - URL Key: `home-hero-badge-en`
   - Content: `Welcome To Saffron Sweets & Bakery`
   - Page Title: Home Hero Badge

4. **Home Hero Primary Button (English)**
   - URL Key: `home-hero-btn-primary-en`
   - Content: `Shop Now`
   - Page Title: Home Hero Primary Button

5. **Home Hero Secondary Button (English)**
   - URL Key: `home-hero-btn-secondary-en`
   - Content: `Our Story`
   - Page Title: Home Hero Secondary Button

### Bangla Content (5 pages)

6. **Home Hero Title (Bangla)**
   - URL Key: `home-hero-title-bn`
   - Content: `প্রথমা মিলেছে উত্কর্মের সাথ প্রতিটি কামড়ে`
   - Page Title: Home Hero Banner Title

7. **Home Hero Subtitle (Bangla)**
   - URL Key: `home-hero-subtitle-bn`
   - Content: `বাংলাদেশের সেরা সংগ্রহের সূক্ষম সংগ্রহ, প্রিমিয়ম চকলেট এবং সতেয়ের তৈরি করা মিষ্টান, পিউর জাফরান এবং ভালোবা দিয়ে তৈরি। প্রজন্ম থেকে চলে আসা রেসিপি দিয়ে তৈরি।`
   - Page Title: Home Hero Banner Subtitle

8. **Home Hero Badge (Bangla)**
   - URL Key: `home-hero-badge-bn`
   - Content: `স্বাফরন মিষ্টি অ্যান্ড বেকারিতে স্বাগতকর নামস্কাম`
   - Page Title: Home Hero Badge

9. **Home Hero Primary Button (Bangla)**
   - URL Key: `home-hero-btn-primary-bn`
   - Content: `এখনই কিনুন`
   - Page Title: Home Hero Primary Button

10. **Home Hero Secondary Button (Bangla)**
    - URL Key: `home-hero-btn-secondary-bn`
    - Content: `আমাদের গল্প`
    - Page Title: Home Hero Secondary Button

## How to Create CMS Pages

1. Login to Admin Panel
2. Navigate to **CMS → Pages**
3. Click **Add Page** button
4. Fill in the details:
   - **Page Name**: Use the Page Title from above
   - **URL Key**: Use the URL Key from above (e.g., `home-hero-title-en`)
   - **Content**: Paste the content from above
   - **Meta Title**: Leave empty or add if needed
   - **Meta Keywords**: Leave empty
   - **Meta Description**: Leave empty
5. Click **Save**

Repeat for all 10 CMS pages.

## Important Notes

- URL Keys must match exactly as specified above (case-sensitive)
- Each URL key is unique and specific to a language (`-en` for English, `-bn` for Bangla)
- Content will automatically load based on the current locale of the site
- Changes made in the Admin panel will reflect immediately on the frontend without code changes

## How It Works

The system automatically:
1. Detects the current locale (English or Bangla)
2. Fetches the appropriate CMS page based on URL key and locale
3. Displays the content in the Hero Banner section

Example:
- When site is in English: Loads `home-hero-title-en`, `home-hero-subtitle-en`, etc.
- When site is in Bangla: Loads `home-hero-title-bn`, `home-hero-subtitle-bn`, etc.

## Benefits

✅ Admin can edit content without touching code
✅ Supports multiple languages (English & Bangla)
✅ Changes reflect immediately
✅ No need for migrations or redeployments
✅ Professional content management workflow

## Code Implementation

The implementation consists of:

1. **HomeController** (`packages/Webkul/Shop/src/Http/Controllers/HomeController.php`)
   - Injects `PageRepository`
   - Fetches CMS content based on locale
   - Passes `$heroBanner` array to view

2. **Blade Template** (`packages/Webkul/Shop/src/Resources/views/home/index.blade.php`)
   - Uses `$heroBanner` array to display dynamic content
   - Falls back to default content if CMS pages don't exist

3. **CMS Pages** (Created via Admin Panel)
   - Store the editable content
   - Organized by locale (English/Bangla)

## Testing

After creating the CMS pages:

1. Test in English:
   - Switch site to English locale
   - Visit homepage
   - Verify Hero Banner shows English content

2. Test in Bangla:
   - Switch site to Bangla locale
   - Visit homepage
   - Verify Hero Banner shows Bangla content

3. Test Admin Editing:
   - Edit any CMS page content
   - Save changes
   - Refresh homepage
   - Verify changes appear immediately

## Troubleshooting

**Content not showing?**
- Check that URL keys match exactly
- Verify CMS pages are published (status = 1)
- Clear cache: `php artisan cache:clear`

**Wrong language showing?**
- Verify locale code (`en` or `bn`)
- Check URL key suffix matches locale
- Ensure both English and Bangla pages exist

**Content not updating?**
- Clear browser cache
- Clear application cache: `php artisan cache:clear`
- Check that you saved the CMS page

## Support

For any issues or questions, refer to:
- Bagisto CMS documentation
- Bagisto localization guide
- Project documentation
