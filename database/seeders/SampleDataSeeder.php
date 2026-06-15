<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\GalleryImage;
use App\Models\ContactSubmission;
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
            'content' => 'Rising absenteeism, teacher burnout, student disengagement — the early warning signs that demand a structured wellbeing intervention. Learn how to conduct a comprehensive wellbeing audit and develop an action plan.',
            'excerpt' => 'Rising absenteeism, teacher burnout, student disengagement — the early warning signs that demand a structured wellbeing intervention.',
            'category' => 'School Wellbeing',
            'read_time' => 5,
            'published_at' => now()->subMonths(2),
        ]);

        BlogPost::create([
            'title' => 'Raising Emotionally Intelligent Children in the Digital Age',
            'slug' => 'raising-emotionally-intelligent-children-digital-age',
            'content' => 'Screen time, social pressure, emotional literacy — how intentional parents build resilience against modern-day stressors. Discover evidence-based strategies for nurturing emotional intelligence in your child.',
            'excerpt' => 'Screen time, social pressure, emotional literacy — how intentional parents build resilience against modern-day stressors.',
            'category' => 'Parenting',
            'read_time' => 7,
            'published_at' => now()->subMonths(1),
        ]);

        BlogPost::create([
            'title' => 'Why Counselling is Not a Crisis Service',
            'slug' => 'why-counselling-not-crisis-service',
            'content' => 'Debunking the myth that counselling is only for when things fall apart — and why proactive support is the smarter investment. Understand the benefits of preventative mental health care.',
            'excerpt' => 'Debunking the myth that counselling is only for when things fall apart — and why proactive support is the smarter investment.',
            'category' => 'Mental Health',
            'read_time' => 4,
            'published_at' => now()->subMonths(1)->subWeeks(2),
        ]);

        BlogPost::create([
            'title' => 'The Role of Peer Support in School Mental Health',
            'slug' => 'peer-support-school-mental-health',
            'content' => 'Training student leaders to provide peer support creates a culture of care that benefits the entire school community. Explore evidence-based peer support models.',
            'excerpt' => 'Training student leaders to provide peer support creates a culture of care that benefits the entire school community.',
            'category' => 'School Wellbeing',
            'read_time' => 6,
            'published_at' => now()->subWeeks(3),
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

        // Sample Contact Submissions
        $submissions = [
            ['first_name' => 'John', 'last_name' => 'Adetunji', 'email' => 'john@example.com', 'phone' => '+2348012345678', 'organisation' => 'Lagos High School', 'service_interest' => 'School Wellbeing Program', 'message' => 'I\'m interested in attending TSCC 2026. Can you send me the detailed agenda?'],
            ['first_name' => 'Mary', 'last_name' => 'Oluwaseun', 'email' => 'mary.oluwaseun@example.com', 'phone' => '+2348023456789', 'organisation' => 'Victoria Island Academy', 'service_interest' => 'Parenting Workshop', 'message' => 'When is the next parenting workshop? I want to register my school.'],
            ['first_name' => 'Samuel', 'last_name' => 'Okafor', 'email' => 'samuel.okafor@example.com', 'phone' => '+2348034567890', 'organisation' => 'Federal College of Education', 'service_interest' => 'School Wellbeing Training', 'message' => 'We are interested in bringing your school wellbeing training program to our institution.'],
            ['first_name' => 'Adeola', 'last_name' => 'Omotoso', 'email' => 'adeola@example.com', 'phone' => '+2348045678901', 'organisation' => 'Independent Counselor', 'service_interest' => 'Speaking Opportunity', 'message' => 'I would like to propose myself as a speaker for upcoming events.'],
            ['first_name' => 'Blessing', 'last_name' => 'Nwosu', 'email' => 'blessing@example.com', 'phone' => '+2348056789012', 'organisation' => 'Mental Health NGO', 'service_interest' => 'Partnership', 'message' => 'Our organization would like to explore partnership opportunities with TREC.'],
        ];

        foreach ($submissions as $submission) {
            ContactSubmission::create($submission);
        }
    }
}


