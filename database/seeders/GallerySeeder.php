<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Imports the photos currently hard-coded on the homepage and gallery page.
     * Only runs when the gallery table is empty.
     */
    public function run()
    {
        if (GalleryImage::query()->exists()) {
            return;
        }

        $home = ['gallery-1.jpg', 'gallery-2.jpeg', 'gallery-7.jpeg', 'gallery-4.jpg', 'gallery-5.jpg', 'gallery-6.jpg'];
        $order = 10;
        foreach ($home as $file) {
            GalleryImage::create([
                'title' => 'Mirissa sri lanka', 'caption' => '12/09/2024', 'category' => 'Homepage',
                'image' => 'img/' . $file, 'alt' => 'Snorkeling',
                'show_on_home' => true, 'show_in_gallery' => false, 'sort_order' => $order,
            ]);
            $order += 10;
        }

        $page = [
            ['TurtleSnorkeling_01.JPG', 'Turtle Snorkeling', 'Turtle Snorkeling'],
            ['TurtleSnorkeling_02.jpg', 'Turtle Snorkeling', 'Turtle Snorkeling'],
        ];
        for ($i = 1; $i <= 7; $i++) {
            $page[] = ['WhalesSnorkeling_0' . $i . '.JPG', 'Whales Snorkeling', 'whales _snorkeling reef in Mirissa'];
        }
        $page[] = ['Branding.png', 'Branding', 'branding'];

        foreach ($page as $item) {
            GalleryImage::create([
                'title' => $item[1], 'category' => $item[1], 'image' => 'img/gallery/' . $item[0], 'alt' => $item[2],
                'show_on_home' => false, 'show_in_gallery' => true, 'sort_order' => $order,
            ]);
            $order += 10;
        }
    }
}
