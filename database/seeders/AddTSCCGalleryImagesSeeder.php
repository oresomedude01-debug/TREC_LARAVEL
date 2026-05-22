<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddTSCCGalleryImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * These are actual TSCC 2025 event images from Google Drive
     */
    public function run(): void
    {
        $images = [
            [
                'label' => 'TSCC 2025 - Opening Ceremony',
                'category' => 'TSCC Conference',
                'image_path' => 'https://drive.google.com/uc?export=view&id=1NxvwJufonqwfRayIwwGm3SRvuZt4ZBwg',
                'height' => 280,
                'color1' => '#D82D37',
                'color2' => '#E56918',
            ],
            [
                'label' => 'TSCC 2025 - Keynote Session',
                'category' => 'TSCC Conference',
                'image_path' => 'https://drive.google.com/uc?export=view&id=1Vz23m7wRh-SGyQGu6tguUTUZ_299v4BE',
                'height' => 260,
                'color1' => '#E56918',
                'color2' => '#779B1C',
            ],
            [
                'label' => 'TSCC 2025 - Workshop Sessions',
                'category' => 'TSCC Conference',
                'image_path' => 'https://drive.google.com/uc?export=view&id=1ZzdVbDyEqfMFDuXZTnha24F37eamv0g8',
                'height' => 280,
                'color1' => '#779B1C',
                'color2' => '#414042',
            ],
            [
                'label' => 'TSCC 2025 - Panel Discussion',
                'category' => 'TSCC Conference',
                'image_path' => 'https://drive.google.com/uc?export=view&id=1bSYyPqNu2k_ifaotmSc6z0SPTROPqQNU',
                'height' => 250,
                'color1' => '#D82D37',
                'color2' => '#779B1C',
            ],
            [
                'label' => 'TSCC 2025 - Networking Break',
                'category' => 'TSCC Conference',
                'image_path' => 'https://drive.google.com/uc?export=view&id=1iNX3Ig2hmlgp-wNwOjk6vnVCDpCdvF4R',
                'height' => 270,
                'color1' => '#E56918',
                'color2' => '#D82D37',
            ],
            [
                'label' => 'TSCC 2025 - Expert Presenters',
                'category' => 'TSCC Conference',
                'image_path' => 'https://drive.google.com/uc?export=view&id=1WDJlaprsGHObXX8axLDx0cnoOdpj9EZa',
                'height' => 260,
                'color1' => '#779B1C',
                'color2' => '#E56918',
            ],
            [
                'label' => 'TSCC 2025 - Attendee Engagement',
                'category' => 'TSCC Conference',
                'image_path' => 'https://drive.google.com/uc?export=view&id=1yB_VfvwkD75DkyazOB9I9hw4I93NXvMP',
                'height' => 280,
                'color1' => '#D82D37',
                'color2' => '#414042',
            ],
            [
                'label' => 'TSCC 2025 - Gallery Display',
                'category' => 'TSCC Conference',
                'image_path' => 'https://drive.google.com/uc?export=view&id=1nbxi-ZWidp0V_4_iEASIaZ6n-3UHigq2',
                'height' => 270,
                'color1' => '#414042',
                'color2' => '#779B1C',
            ],
            [
                'label' => 'TSCC 2025 - Participant Group',
                'category' => 'TSCC Conference',
                'image_path' => 'https://drive.google.com/uc?export=view&id=1bffEmSGxdprfEllwlhSSAOGVd3lzLTWw',
                'height' => 275,
                'color1' => '#E56918',
                'color2' => '#414042',
            ],
            [
                'label' => 'TSCC 2025 - Live Photography',
                'category' => 'TSCC Conference',
                'image_path' => 'https://drive.google.com/uc?export=view&id=1NvDOjlod4DByoy8PtmKizhPSKCHjx_im',
                'height' => 265,
                'color1' => '#D82D37',
                'color2' => '#E56918',
            ],
            [
                'label' => 'TSCC 2025 - Indoor Venue',
                'category' => 'TSCC Conference',
                'image_path' => 'https://drive.google.com/uc?export=view&id=1yWTaKVz8HccJL7I_93SYIF1taWj2J6Kr',
                'height' => 280,
                'color1' => '#779B1C',
                'color2' => '#D82D37',
            ],
            [
                'label' => 'TSCC 2025 - Closing Remarks',
                'category' => 'TSCC Conference',
                'image_path' => 'https://drive.google.com/uc?export=view&id=1N450COe9V66_xld4oiQfC1t51VCF0vlC',
                'height' => 270,
                'color1' => '#414042',
                'color2' => '#E56918',
            ],
        ];

        // Delete existing TSCC gallery images
        GalleryImage::where('category', 'TSCC Conference')->delete();

        // Insert new images
        foreach ($images as $image) {
            GalleryImage::create($image);
        }
    }
}


