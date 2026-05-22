<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\GalleryImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample Blog Posts
        BlogPost::create([
            'title' => '5 Signs Your School Needs a Wellbeing Audit',
            'slug' => '5-signs-school-needs-wellbeing-audit',
            'content' => 'Rising absenteeism, teacher burnout, student disengagement — the early warning signs that demand a structured wellbeing intervention.',
            'excerpt' => 'Rising absenteeism, teacher burnout, student disengagement — the early warning signs that demand a structured wellbeing intervention.',
            'category' => 'School Wellbeing',
            'read_time' => 5,
            'published_at' => now()->subMonths(2),
        ]);

        BlogPost::create([
            'title' => 'Raising Emotionally Intelligent Children in the Digital Age',
            'slug' => 'raising-emotionally-intelligent-children-digital-age',
            'content' => 'Screen time, social pressure, emotional literacy — how intentional parents build resilience against modern-day stressors.',
            'excerpt' => 'Screen time, social pressure, emotional literacy — how intentional parents build resilience against modern-day stressors.',
            'category' => 'Parenting',
            'read_time' => 7,
            'published_at' => now()->subMonths(1),
        ]);

        BlogPost::create([
            'title' => 'Why Counselling is Not a Crisis Service',
            'slug' => 'why-counselling-not-crisis-service',
            'content' => 'Debunking the myth that counselling is only for when things fall apart — and why proactive support is the smarter investment.',
            'excerpt' => 'Debunking the myth that counselling is only for when things fall apart — and why proactive support is the smarter investment.',
            'category' => 'Mental Health',
            'read_time' => 4,
            'published_at' => now()->subMonths(1)->subWeeks(2),
        ]);

        // Sample Gallery Images
        $galleryCategories = [
            ['label' => 'TSCC 2024 — Opening Keynote', 'cat' => 'tscc', 'h' => 260, 'c1' => '#8a1520', 'c2' => '#D82D37'],
            ['label' => 'Parenting Workshop — Lagos', 'cat' => 'workshop', 'h' => 190, 'c1' => '#3a5a0a', 'c2' => '#779B1C'],
            ['label' => 'School Wellbeing Session', 'cat' => 'school', 'h' => 220, 'c1' => '#7a3a0a', 'c2' => '#E56918'],
            ['label' => 'TSCC 2024 — Panel Discussion', 'cat' => 'tscc', 'h' => 180, 'c1' => '#8a1520', 'c2' => '#D82D37'],
            ['label' => 'Community Counselling Drive', 'cat' => 'community', 'h' => 250, 'c1' => '#3a5a0a', 'c2' => '#779B1C'],
            ['label' => 'Corporate Training — EQ Workshop', 'cat' => 'workshop', 'h' => 200, 'c1' => '#7a3a0a', 'c2' => '#E56918'],
            ['label' => 'Teacher Wellbeing Day', 'cat' => 'school', 'h' => 170, 'c1' => '#1a1a3a', 'c2' => '#414042'],
            ['label' => 'TSCC 2024 — Networking', 'cat' => 'tscc', 'h' => 230, 'c1' => '#8a1520', 'c2' => '#D82D37'],
        ];

        foreach ($galleryCategories as $item) {
            GalleryImage::create([
                'label' => $item['label'],
                'category' => $item['cat'],
                'image_path' => '/storage/gallery/' . \Illuminate\Support\Str::slug($item['label']) . '.jpg',
                'height' => $item['h'],
                'color1' => $item['c1'],
                'color2' => $item['c2'],
            ]);
        }
    }
}

