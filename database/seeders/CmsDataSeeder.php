<?php

namespace Database\Seeders;

use App\Models\CmsContent;
use Illuminate\Database\Seeder;

class CmsDataSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            'home' => [
                ['section' => 'hero', 'label' => 'Hero', 'eyebrow' => 'Two Bali Branches, Two Distinct Moods', 'title' => 'Acala Bar & Bistro', 'cta_label' => 'Book a Table'],
                ['section' => 'why_acala', 'label' => 'Why Choose Acala', 'title' => 'Why Choose Acala ?', 'body' => "Whether you’re in Nusa Lembongan or Nusa Dua, the essence of Acala remains the same: an honest, flavour-driven approach to food, crafted to bring people together. Acala, meaning 'mountain' in Sanskrit, stands as a testament to reliability and a solid foundation. Our chefs source local ingredients, highlighting the vibrant tastes of Bali across all our menus."],
                ['section' => 'locations', 'label' => 'Our Locations', 'eyebrow' => 'Our Locations', 'title' => 'Find Your Acala', 'body' => "We invite you to experience our hospitality across two unique settings in Bali."],
                ['section' => 'story', 'label' => 'Our Story', 'eyebrow' => 'Our Story', 'title' => 'Where Flavours Meet Heart', 'body' => "Acala Bar & Bistro isn't just about dining; it's about sharing moments. Born from a passion for authentic culinary experiences, we aim to deliver more than just a meal."],
                ['section' => 'staff', 'label' => 'Our Staff', 'eyebrow' => 'Our Staff', 'title' => 'The People Behind the Plates', 'body' => "Our team is the soul of Acala. Dedicated, warm, and highly skilled, they ensure every visit feels like coming home."],
                ['section' => 'menu_categories', 'label' => 'Menu Categories', 'eyebrow' => 'Our Menu', 'title' => 'Taste the Acala Difference', 'body' => "Explore our carefully curated selection of dishes, from fresh seafood to comforting classics."],
                ['section' => 'branch_gallery', 'label' => 'Branch Gallery', 'eyebrow' => 'Branch Gallery', 'title' => 'Two Locations, Two Moods', 'body' => "Browse through moments captured at Acala Nusa Dua and Acala Nusa Lembongan."],
                ['section' => 'blog_highlight', 'label' => 'Blog Highlight', 'eyebrow' => 'Blog Highlight', 'title' => 'Stories & Insights', 'body' => "Dive into our latest journal entries, recipes, and updates from the Acala family."],
                ['section' => 'cta', 'label' => 'Booking CTA', 'eyebrow' => 'Join Us', 'title' => 'Ready for an Unforgettable Dining Experience?', 'body' => "Reserve your table today and let us take care of the rest.", 'cta_label' => 'Book Now', 'image' => '/Branch/Acala nusa dua/DSC00742-HDR.jpg'],
            ],
            'about' => [
                ['section' => 'hero', 'label' => 'Hero', 'eyebrow' => 'Our Story', 'title' => 'About Acala', 'image' => '/About/staff nusa lembongan.jpg'],
                ['section' => 'story', 'label' => 'Story', 'eyebrow' => 'Our Story', 'title' => 'Two Bali Branches, One Warm Welcome', 'body' => "Acala Bar & Bistro began in Nusa Lembongan as a place for people to slow down, eat well, and feel at home after a day on the island.\n\nAs Acala grew to Nusa Dua, the heart stayed the same. Lembongan carries a casual pizza, seafood, and chill hangout energy, while Nusa Dua brings authentic Indonesian food, seafood, and a romantic dining mood at Bali Collection.\n\nThe name Acala reflects steadiness: quality food, thoughtful service, and spaces made for shared moments."],
                ['section' => 'nusa_dua_team', 'label' => 'Nusa Dua Team', 'eyebrow' => 'Our Staff', 'title' => 'Nusa Dua Team', 'body' => "A focused kitchen and service team behind Indonesian classics, seafood, and romantic dinner moments.", 'image' => '/Branch/Acala nusa dua/Copy of DSC03521.jpg', 'cta_label' => 'View Branch'],
                ['section' => 'nusa_lembongan_team', 'label' => 'Nusa Lembongan Team', 'eyebrow' => 'Our Staff', 'title' => 'Nusa Lembongan Team', 'body' => "A relaxed island team serving breakfast, pizza lunches, seafood dinners, and easy hospitality.", 'image' => '/About/staff nusa lembongan.jpg', 'cta_label' => 'View Branch'],
                ['section' => 'blog_highlight', 'label' => 'Blog Highlight', 'eyebrow' => 'Blog Highlight', 'title' => 'Acala Highlights', 'body' => "Branch stories, food moments, and the dining moods guests can expect."],
                ['section' => 'visit_cta', 'label' => 'Visit CTA', 'title' => 'Visit the Acala That Fits Your Day', 'body' => "Explore our locations and find the perfect setting for your next meal."],
            ],
            'branches' => [
                ['section' => 'hero', 'label' => 'Hero', 'eyebrow' => '2 Locations Across Bali', 'title' => 'Our Locations', 'image' => '/Branch/Acala nusa dua/DSC00742-HDR.jpg'],
                ['section' => 'locations_intro', 'label' => 'Locations Intro', 'eyebrow' => 'Where to Find Us', 'title' => 'Choose Your Acala', 'body' => "Lembongan is for brunch, breakfast, coffee, pizza, lunch, drinks, and bar energy. Nusa Dua is for Indonesian cuisine, seafood, Western dishes, and dinner at Bali Collection."],
                ['section' => 'branch_cards', 'label' => 'Branch Cards', 'body' => ''],
                ['section' => 'spirit', 'label' => 'Two Locations Spirit', 'title' => 'Two Locations, One Spirit', 'body' => "Whether you are searching for places to eat in Nusa Lembongan or a restaurant in Nusa Dua near Bali Collection, Acala keeps each branch distinct while carrying the same warm service, fresh food, and relaxed Bali hospitality."],
            ],
            'menu' => [
                ['section' => 'hero', 'label' => 'Hero', 'eyebrow' => 'Our Food & Drinks', 'title' => 'The Menus', 'body' => "From fresh seafood and authentic Indonesian cuisine in Nusa Dua to wood-fired pizza and relaxed brunch in Nusa Lembongan.", 'image' => '/Branch/Acala nusa dua/DSC03517.jpg'],
                ['section' => 'branch_tabs', 'label' => 'Branch Tabs', 'title' => 'Select Branch Menu', 'body' => "Menus vary by location to highlight the best of what each branch offers."],
                ['section' => 'menu_section', 'label' => 'Menu Section', 'title' => 'Discover Our Selection', 'body' => ""],
                ['section' => 'notice', 'label' => 'Price Notice', 'body' => "All prices are in thousands of Rupiah (k) and are subject to 10% service charge and applicable government tax."],
            ],
            'gallery' => [
                ['section' => 'hero', 'label' => 'Hero', 'eyebrow' => 'Visual Journey', 'title' => 'Gallery', 'body' => "A glimpse into the Acala experience across Bali.", 'image' => '/About/staff nusa lembongan.jpg'],
                ['section' => 'branch_gallery', 'label' => 'Branch Gallery', 'eyebrow' => 'The Spaces', 'title' => 'Two Unique Atmospheres', 'body' => "Browse our curated moments from Nusa Dua and Nusa Lembongan."],
                ['section' => 'branch_cta', 'label' => 'Branch CTA', 'eyebrow' => 'Explore More', 'title' => 'Discover the Full Experience', 'body' => "Visit our branch pages to see more details, menus, and booking options."],
                ['section' => 'blog_highlight', 'label' => 'Blog Highlight', 'eyebrow' => 'Behind the Scenes', 'title' => 'Stories from the Gallery', 'body' => "Read about the moments and people that make Acala special."],
            ],
            'blog' => [
                ['section' => 'hero', 'label' => 'Hero', 'eyebrow' => 'Acala Journal', 'title' => 'Stories from Acala', 'body' => "Food, hospitality, and life across our two Bali locations.", 'image' => '/Branch/Acala nusa dua/Copy of DSC03456.jpg'],
                ['section' => 'featured_story', 'label' => 'Featured Story', 'eyebrow' => 'Featured Story', 'title' => 'Latest Feature', 'body' => "", 'cta_label' => 'Read Story'],
                ['section' => 'article_list', 'label' => 'Article List', 'eyebrow' => 'All Stories', 'title' => 'Recent Articles', 'body' => "Explore our journal entries."],
                ['section' => 'branch_notes', 'label' => 'Branch Notes', 'eyebrow' => 'Visit Us', 'title' => 'Experience It Yourself', 'body' => "Read the stories, then come taste the food."],
                ['section' => 'closing_cta', 'label' => 'Closing CTA', 'eyebrow' => 'Plan Your Visit', 'title' => 'Reserve Your Table', 'body' => "We look forward to welcoming you to Acala Bar & Bistro.", 'cta_label' => 'Book a Table', 'image' => '/Branch/Acala lembongan/galery/Copy of DSC08301.jpg'],
            ],
            'contact' => [
                ['section' => 'hero', 'label' => 'Hero', 'eyebrow' => 'Get in Touch', 'title' => 'Contact Us', 'body' => "We're here to help with reservations, inquiries, and special requests.", 'image' => '/Branch/Acala nusa dua/DSC03517.jpg'],
                ['section' => 'fast_actions', 'label' => 'Fast Actions', 'eyebrow' => 'Quick Contact', 'title' => 'How can we help?', 'body' => "Reach out via WhatsApp or book a table directly."],
                ['section' => 'branch_contacts', 'label' => 'Branch Contacts', 'eyebrow' => 'Locations', 'title' => 'Our Branches', 'body' => "Find contact details and directions for each branch below."],
                ['section' => 'blog_highlight', 'label' => 'Blog Highlight', 'eyebrow' => 'Latest Updates', 'title' => 'From the Journal', 'body' => "Read our latest news while you wait for our reply."],
            ],
            'reservation' => [
                ['section' => 'hero', 'label' => 'Hero', 'eyebrow' => 'Online Booking', 'title' => 'Reserve a Table', 'body' => "Secure your spot at Acala Bar & Bistro.", 'image' => '/About/staff nusa lembongan.jpg'],
                ['section' => 'booking_intro', 'label' => 'Booking Intro', 'eyebrow' => 'Choose Location', 'title' => 'Where will you dine?', 'body' => "Select your preferred branch to make a reservation."],
                ['section' => 'branch_booking_cards', 'label' => 'Branch Booking Cards', 'body' => ""],
            ],
            'branch-nusa-dua' => [
                ['section' => 'hero', 'label' => 'Hero', 'title' => 'Acala Nusa Dua', 'subtitle' => 'Indonesian Cuisine & Seafood in Bali Collection', 'image' => '/Branch/Acala nusa dua/DSC00742-HDR.jpg'],
                ['section' => 'seo_story', 'label' => 'Branch Story', 'eyebrow' => 'The Nusa Dua Experience', 'title' => 'A Taste of Indonesia', 'body' => "At Acala Nusa Dua, we celebrate authentic Indonesian cuisine and fresh seafood, right in the heart of Bali Collection.\n\nWhether you are joining us for a family lunch or a romantic dinner, our warm hospitality and carefully crafted dishes promise an unforgettable dining experience in Nusa Dua."],
                ['section' => 'moments', 'label' => 'Moments', 'eyebrow' => 'Branch Highlight', 'title' => 'Dining by the Moment', 'body' => "From sunny lunches to relaxed dinners, experience the unique rhythm of Nusa Dua."],
                ['section' => 'menu', 'label' => 'Menu Highlight', 'eyebrow' => 'Our Menu', 'title' => 'Menu by Category', 'body' => "Appetizer, main course, dessert, and drink selections are grouped for easier browsing."],
                ['section' => 'gallery', 'label' => 'Gallery', 'title' => 'Branch Gallery', 'body' => "A glimpse into our space at Bali Collection."],
                ['section' => 'map_contact', 'label' => 'Map & Contact', 'title' => 'Find Us', 'subtitle' => 'Contact Details'],
            ],
            'branch-nusa-lembongan' => [
                ['section' => 'hero', 'label' => 'Hero', 'title' => 'Acala Nusa Lembongan', 'subtitle' => 'Brunch, Pizza, and Relaxed Island Dining', 'image' => '/About/staff nusa lembongan.jpg'],
                ['section' => 'seo_story', 'label' => 'Branch Story', 'eyebrow' => 'The Lembongan Spirit', 'title' => 'Laid-back Island Vibes', 'body' => "Acala Nusa Lembongan is your go-to spot for brunch, coffee, wood-fired pizza, and relaxed island drinks.\n\nLocated on the beautiful island of Nusa Lembongan, we offer a casual and welcoming atmosphere perfect for unwinding after a day of exploring or diving."],
                ['section' => 'moments', 'label' => 'Moments', 'eyebrow' => 'Branch Highlight', 'title' => 'Dining by the Moment', 'body' => "Start with breakfast and stay until evening drinks in our relaxed setting."],
                ['section' => 'menu', 'label' => 'Menu Highlight', 'eyebrow' => 'Our Menu', 'title' => 'Menu by Category', 'body' => "Appetizer, main course, dessert, and drink selections are grouped for easier browsing."],
                ['section' => 'gallery', 'label' => 'Gallery', 'title' => 'Branch Gallery', 'body' => "Explore our island-inspired space."],
                ['section' => 'map_contact', 'label' => 'Map & Contact', 'title' => 'Find Us', 'subtitle' => 'Contact Details'],
            ]
        ];

        $sortOrder = 10;
        foreach ($pages as $pageName => $sections) {
            foreach ($sections as $index => $section) {
                CmsContent::updateOrCreate(
                    [
                        'page' => $pageName,
                        'section' => $section['section'],
                    ],
                    [
                        'label' => $section['label'],
                        'eyebrow' => $section['eyebrow'] ?? null,
                        'title' => $section['title'] ?? null,
                        'subtitle' => $section['subtitle'] ?? null,
                        'body' => $section['body'] ?? null,
                        'image' => $section['image'] ?? null,
                        'cta_label' => $section['cta_label'] ?? null,
                        'sort_order' => $sortOrder,
                        'is_published' => true,
                    ]
                );
                $sortOrder += 10;
            }
        }
    }
}
