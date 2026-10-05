<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cms_images', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // e.g. "home.cta", "about.hero", "branch.nusa_dua.exterior"
            $table->string('group');         // e.g. "Home", "About", "Branch – Nusa Dua"
            $table->string('label');         // e.g. "Home CTA Background"
            $table->string('path');          // URL/path to image
            $table->string('alt')->default(''); // SEO alt text
            $table->timestamps();
        });

        $now = now();

        $images = [
            // ── Home ─────────────────────────────────────────────────────────
            [
                'key'   => 'home.hero_collage.1',
                'group' => 'Home',
                'label' => 'Hero Collage – Nusa Dua Beach',
                'path'  => '/Home/1. nusa dua beach.jpg',
                'alt'   => 'Nusa Dua beach view near Acala Bar & Bistro',
            ],
            [
                'key'   => 'home.hero_collage.2',
                'group' => 'Home',
                'label' => 'Hero Collage – Hero 2',
                'path'  => '/Home/2. Hero-2.jpg',
                'alt'   => 'Acala Bar & Bistro dining ambience',
            ],
            [
                'key'   => 'home.hero_collage.3',
                'group' => 'Home',
                'label' => 'Hero Collage – Nusa Lembongan',
                'path'  => '/Home/3. nusa lembogan.jpg',
                'alt'   => 'Nusa Lembongan branch exterior',
            ],
            [
                'key'   => 'home.hero_collage.4',
                'group' => 'Home',
                'label' => 'Hero Collage – Hero 4',
                'path'  => '/Home/4. hero-4.jpg',
                'alt'   => 'Acala Bar & Bistro food and drinks',
            ],
            [
                'key'   => 'home.gallery.1',
                'group' => 'Home',
                'label' => 'Gallery – Slide 1',
                'path'  => '/Home/galery/gallery-1.webp',
                'alt'   => 'Acala dining experience',
            ],
            [
                'key'   => 'home.gallery.2',
                'group' => 'Home',
                'label' => 'Gallery – Slide 2',
                'path'  => '/Home/galery/gallery-2.webp',
                'alt'   => 'Acala food presentation',
            ],
            [
                'key'   => 'home.gallery.3',
                'group' => 'Home',
                'label' => 'Gallery – Slide 3',
                'path'  => '/Home/galery/gallery-3.webp',
                'alt'   => 'Acala Bar & Bistro ambience',
            ],
            [
                'key'   => 'home.gallery.4',
                'group' => 'Home',
                'label' => 'Gallery – Slide 4',
                'path'  => '/Home/galery/gallery-4.webp',
                'alt'   => 'Acala outdoor seating',
            ],
            [
                'key'   => 'home.gallery.5',
                'group' => 'Home',
                'label' => 'Gallery – Slide 5',
                'path'  => '/Home/galery/gallery-5.webp',
                'alt'   => 'Acala signature dishes',
            ],
            [
                'key'   => 'home.gallery.6',
                'group' => 'Home',
                'label' => 'Gallery – Slide 6',
                'path'  => '/Home/galery/gallery-6.webp',
                'alt'   => 'Acala tropical setting',
            ],
            [
                'key'   => 'home.gallery.ads',
                'group' => 'Home',
                'label' => 'Gallery – ADS Feature',
                'path'  => '/Home/galery/ADS01942.jpg',
                'alt'   => 'Acala Nusa Lembongan interior',
            ],
            [
                'key'   => 'home.why_acala.nusa_dua.indonesian_food',
                'group' => 'Home – Why Acala',
                'label' => 'Why Acala – Nusa Dua Indonesian Food',
                'path'  => '/Home/why-acala/nusa-dua/indonesian-food.jpg',
                'alt'   => 'Traditional Indonesian food at Acala Nusa Dua',
            ],
            [
                'key'   => 'home.why_acala.nusa_dua.seafood',
                'group' => 'Home – Why Acala',
                'label' => 'Why Acala – Nusa Dua Seafood',
                'path'  => '/Home/why-acala/nusa-dua/seafood.jpg',
                'alt'   => 'Fresh seafood at Acala Nusa Dua',
            ],
            [
                'key'   => 'home.why_acala.nusa_dua.valentine',
                'group' => 'Home – Why Acala',
                'label' => 'Why Acala – Nusa Dua Valentine',
                'path'  => '/Home/why-acala/nusa-dua/valentine.jpg',
                'alt'   => 'Romantic dining experience at Acala Nusa Dua',
            ],
            [
                'key'   => 'home.why_acala.nusa_lembongan.pizza',
                'group' => 'Home – Why Acala',
                'label' => 'Why Acala – Nusa Lembongan Pizza',
                'path'  => '/Home/why-acala/nusa-lembongan/pizza.jpg',
                'alt'   => 'Handcrafted pizza at Acala Nusa Lembongan',
            ],
            [
                'key'   => 'home.why_acala.nusa_lembongan.seafood',
                'group' => 'Home – Why Acala',
                'label' => 'Why Acala – Nusa Lembongan Seafood',
                'path'  => '/Home/why-acala/nusa-lembongan/seafood.jpg',
                'alt'   => 'Fresh seafood at Acala Nusa Lembongan',
            ],
            // ── About ────────────────────────────────────────────────────────
            [
                'key'   => 'about.hero',
                'group' => 'About',
                'label' => 'About – Hero Background',
                'path'  => '/About/staff nusa lembongan.jpg',
                'alt'   => 'Acala Nusa Lembongan staff',
            ],
            // ── Branch – Nusa Dua ────────────────────────────────────────────
            [
                'key'   => 'branch.nusa_dua.exterior',
                'group' => 'Branch – Nusa Dua',
                'label' => 'Nusa Dua – Exterior',
                'path'  => '/Branch/Acala nusa dua/depan-restorant.jpg',
                'alt'   => 'Acala Nusa Dua restaurant exterior',
            ],
            [
                'key'   => 'branch.nusa_dua.hero',
                'group' => 'Branch – Nusa Dua',
                'label' => 'Nusa Dua – Hero',
                'path'  => '/Branch/Acala nusa dua/DSC00742-HDR.jpg',
                'alt'   => 'Acala Nusa Dua dining experience',
            ],
            [
                'key'   => 'branch.nusa_dua.gallery.1',
                'group' => 'Branch – Nusa Dua',
                'label' => 'Nusa Dua – Gallery 1',
                'path'  => '/Branch/Acala nusa dua/Copy of DSC03302.jpg',
                'alt'   => 'Acala Nusa Dua interior view',
            ],
            [
                'key'   => 'branch.nusa_dua.gallery.2',
                'group' => 'Branch – Nusa Dua',
                'label' => 'Nusa Dua – Gallery 2',
                'path'  => '/Branch/Acala nusa dua/Copy of DSC03358.jpg',
                'alt'   => 'Acala Nusa Dua food and drinks',
            ],
            [
                'key'   => 'branch.nusa_dua.gallery.3',
                'group' => 'Branch – Nusa Dua',
                'label' => 'Nusa Dua – Gallery 3',
                'path'  => '/Branch/Acala nusa dua/Copy of DSC03396.jpg',
                'alt'   => 'Acala Nusa Dua ambience',
            ],
            [
                'key'   => 'branch.nusa_dua.gallery.4',
                'group' => 'Branch – Nusa Dua',
                'label' => 'Nusa Dua – Gallery 4',
                'path'  => '/Branch/Acala nusa dua/Copy of DSC03456.jpg',
                'alt'   => 'Dining at Acala Nusa Dua',
            ],
            [
                'key'   => 'branch.nusa_dua.gallery.5',
                'group' => 'Branch – Nusa Dua',
                'label' => 'Nusa Dua – Gallery 5',
                'path'  => '/Branch/Acala nusa dua/Copy of DSC03521.jpg',
                'alt'   => 'Acala Nusa Dua evening setting',
            ],
            [
                'key'   => 'branch.nusa_dua.gallery.6',
                'group' => 'Branch – Nusa Dua',
                'label' => 'Nusa Dua – Gallery 6',
                'path'  => '/Branch/Acala nusa dua/Copy of RSK-133.jpg',
                'alt'   => 'Acala Nusa Dua bar area',
            ],
            // ── Branch – Nusa Lembongan ──────────────────────────────────────
            [
                'key'   => 'branch.nusa_lembongan.exterior',
                'group' => 'Branch – Nusa Lembongan',
                'label' => 'Nusa Lembongan – Exterior',
                'path'  => '/Branch/Acala lembongan/depan-restorant.jpeg',
                'alt'   => 'Acala Nusa Lembongan restaurant exterior',
            ],
            [
                'key'   => 'branch.nusa_lembongan.gallery.1',
                'group' => 'Branch – Nusa Lembongan',
                'label' => 'Nusa Lembongan – Gallery 1',
                'path'  => '/Branch/Acala lembongan/galery/Copy of ADS01862.jpg',
                'alt'   => 'Acala Nusa Lembongan interior',
            ],
            [
                'key'   => 'branch.nusa_lembongan.gallery.2',
                'group' => 'Branch – Nusa Lembongan',
                'label' => 'Nusa Lembongan – Gallery 2',
                'path'  => '/Branch/Acala lembongan/galery/Copy of ADS01903.jpg',
                'alt'   => 'Acala Nusa Lembongan dining area',
            ],
            [
                'key'   => 'branch.nusa_lembongan.gallery.3',
                'group' => 'Branch – Nusa Lembongan',
                'label' => 'Nusa Lembongan – Gallery 3',
                'path'  => '/Branch/Acala lembongan/galery/Copy of ADS01942.jpg',
                'alt'   => 'Acala Nusa Lembongan ambience',
            ],
            [
                'key'   => 'branch.nusa_lembongan.gallery.4',
                'group' => 'Branch – Nusa Lembongan',
                'label' => 'Nusa Lembongan – Gallery 4',
                'path'  => '/Branch/Acala lembongan/galery/Copy of DSC08301.jpg',
                'alt'   => 'Acala Nusa Lembongan outdoor area',
            ],
            [
                'key'   => 'branch.nusa_lembongan.gallery.5',
                'group' => 'Branch – Nusa Lembongan',
                'label' => 'Nusa Lembongan – Gallery 5',
                'path'  => '/Branch/Acala lembongan/galery/Copy of DSC08311.jpg',
                'alt'   => 'Acala Nusa Lembongan tropical setting',
            ],
            // ── Menu ────────────────────────────────────────────────────────
            [
                'key'   => 'menu.hero',
                'group' => 'Menu',
                'label' => 'Menu – Hero Background',
                'path'  => '/Menu/home-menu.jpg',
                'alt'   => 'Acala menu showcase',
            ],
        ];

        foreach ($images as $image) {
            DB::table('cms_images')->insert(array_merge($image, [
                'created_at' => $now,
                'updated_at' => $now,
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('cms_images');
    }
};
