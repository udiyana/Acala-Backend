<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cms_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page')->index();
            $table->string('section')->index();
            $table->string('label')->nullable();
            $table->string('eyebrow')->nullable();
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->longText('body')->nullable();
            $table->string('image')->nullable();
            $table->string('cta_label')->nullable();
            $table->string('cta_url')->nullable();
            $table->json('metadata')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->unique(['page', 'section']);
        });

        $now = now();

        foreach ([
            [
                'page' => 'home',
                'section' => 'hero',
                'label' => 'Home Hero',
                'eyebrow' => 'Two Bali Branches, Two Distinct Moods',
                'title' => 'Acala Bar & Bistro',
                'body' => 'Acala has two Bali branches with their own character: Nusa Lembongan is the relaxed island restaurant for brunch, breakfast, coffee, pizza, lunch, drinks, and bar moments, while Nusa Dua is a tropical restaurant in Bali Collection for Indonesian cuisine, seafood, Western favorites, and dinner.',
                'cta_label' => 'Book a Table',
                'cta_url' => 'https://wa.me/6281337043131',
                'sort_order' => 10,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'page' => 'home',
                'section' => 'why_acala',
                'label' => 'Home Why Acala',
                'eyebrow' => null,
                'title' => 'Why Choose Acala ?',
                'body' => 'Choose the branch that fits your mood, then see what makes each Acala experience different.',
                'sort_order' => 20,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'page' => 'home',
                'section' => 'locations',
                'label' => 'Home Locations',
                'eyebrow' => 'Our Locations',
                'title' => 'Find Your Acala',
                'body' => 'Get directions, explore each branch, or book directly through Chope.',
                'sort_order' => 30,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'page' => 'home',
                'section' => 'story',
                'label' => 'Home Story',
                'eyebrow' => 'Our Story',
                'title' => 'Built Around Food, People, and Bali Hospitality',
                'body' => 'Acala began in Nusa Lembongan and grew into Nusa Dua with the same promise: create a comfortable place where guests can eat well, stay longer, and feel looked after. From Indonesian classics to pizza and seafood, every branch carries its own local mood.',
                'sort_order' => 40,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'page' => 'home',
                'section' => 'staff',
                'label' => 'Home Staff',
                'eyebrow' => 'Our Staff',
                'title' => 'The People Behind the Welcome',
                'body' => 'Our teams in Lembongan and Nusa Dua bring the same warmth to two very different dining settings.',
                'sort_order' => 50,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'page' => 'home',
                'section' => 'menu_categories',
                'label' => 'Home Menu Categories',
                'eyebrow' => 'Menu Categories',
                'title' => 'Appetizer, Main Course, Dessert, Drink',
                'body' => 'Choose a branch, then scan the four menu categories before contacting Acala.',
                'sort_order' => 60,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'page' => 'home',
                'section' => 'blog_highlight',
                'label' => 'Home Blog Highlight',
                'eyebrow' => 'Blog Highlight',
                'title' => 'Acala Highlights',
                'body' => 'Branch stories, food moments, and quick reads from Nusa Lembongan and Nusa Dua.',
                'sort_order' => 70,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'page' => 'home',
                'section' => 'cta',
                'label' => 'Home CTA',
                'eyebrow' => 'Book Now',
                'title' => 'Ready for Acala?',
                'body' => 'Pick your branch and book your table for Nusa Lembongan or Nusa Dua.',
                'image' => '/Branch/Acala nusa dua/DSC00742-HDR.jpg',
                'sort_order' => 80,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'page' => 'about',
                'section' => 'hero',
                'label' => 'About Hero',
                'eyebrow' => 'Our Story',
                'title' => 'About Acala',
                'image' => '/About/staff nusa lembongan.jpg',
                'sort_order' => 10,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'page' => 'about',
                'section' => 'story',
                'label' => 'About Story',
                'eyebrow' => 'Our Story',
                'title' => 'Two Bali Branches, One Warm Welcome',
                'body' => "Acala Bar & Bistro began in Nusa Lembongan as a place for people to slow down, eat well, and feel at home after a day on the island.\n\nAs Acala grew to Nusa Dua, the heart stayed the same. Lembongan carries a casual pizza, seafood, and chill hangout energy, while Nusa Dua brings authentic Indonesian food, seafood, and a romantic dining mood at Bali Collection.\n\nThe name Acala reflects steadiness: quality food, thoughtful service, and spaces made for shared moments.",
                'sort_order' => 20,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'page' => 'contact',
                'section' => 'hero',
                'label' => 'Contact Hero',
                'title' => 'Contact Us',
                'body' => 'Reach Acala by WhatsApp, email reservation, Chope booking, or branch directions.',
                'image' => '/Branch/Acala nusa dua/DSC00742-HDR.jpg',
                'sort_order' => 10,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'page' => 'menu',
                'section' => 'hero',
                'label' => 'Menu Hero',
                'eyebrow' => 'Branch Menus',
                'title' => 'Our Menu',
                'body' => 'Choose a branch and browse Appetizer, Main Course, Dessert, and Drink categories.',
                'image' => '/Menu/home-menu.jpg',
                'sort_order' => 10,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'page' => 'gallery',
                'section' => 'hero',
                'label' => 'Gallery Hero',
                'eyebrow' => 'Gallery',
                'title' => 'Acala Gallery',
                'body' => 'Food, ambience, and video-style highlights from Nusa Lembongan and Nusa Dua.',
                'image' => '/Branch/Acala lembongan/galery/Copy of ADS01942.jpg',
                'sort_order' => 10,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ] as $content) {
            DB::table('cms_contents')->insert($content);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_contents');
    }
};
