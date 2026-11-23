<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PackageSeeder extends Seeder
{
    /**
     * Imports the tours that are currently hard-coded on the website.
     * Only runs when the packages table is empty.
     */
    public function run()
    {
        if (Package::query()->exists()) {
            return;
        }

        $packages = [
            [
                'name' => 'Blue Whale Watching', 'price' => 50, 'image' => 'img/price-4.png', 'show_on_home' => true,
                'pickup_time' => '6:00 AM', 'duration' => '3 to 5 Hrs',
                'features' => ['Pickup 6 am', 'Breakfast Tea, Coffee,Fruits', 'Water Bottles', '3 to 5 Hrs'],
            ],
            [
                'name' => 'Blue Whale Snorkeling', 'price' => null, 'image' => 'img/price-14.jpg', 'show_on_home' => true,
                'pickup_time' => '6:00 AM', 'duration' => '3 to 5 Hrs', 'detail_url' => 'view_blue_whale_snorkeling',
                'features' => ['Pickup 6 am', 'Breakfast Tea, Coffee,Fruits', 'Water Bottles', '3 to 5 Hrs', 'Swimming Equipments', 'Gopro Camera', 'Tirtule, Dolphin Watching'],
            ],
            [
                'name' => 'Dolpin Snorkeling', 'price' => null, 'image' => 'img/price-15.png', 'show_on_home' => true,
                'pickup_time' => '6 - 10 AM', 'duration' => '3 to 4 Hrs',
                'features' => ['Pickup Best Time 6 - 10 am', 'Breakfast Tea, Coffee,Fruits', '3 Hrs to 4 Hrs', 'Swimming Equipments', 'Gopro Camera', 'Water Bottles'],
            ],
            [
                'name' => 'Turtle Snorkeling Shallow Water', 'price' => 20, 'image' => 'img/price-7.jpg', 'show_on_home' => true,
                'pickup_time' => '8 AM - 1 PM', 'duration' => '2 Hours',
                'features' => ['Best Time 8am to 1pm', 'Swimming Equipments', 'Gopro Camera', '2 Hours tour '],
            ],
            ['name' => 'Free diving', 'price' => null, 'image' => null, 'show_on_home' => false, 'features' => []],
            [
                'name' => 'Deep Sea Fishing Tour', 'price' => 125, 'image' => 'img/price-9.jpg', 'show_on_home' => true,
                'pickup_time' => '6:00 AM', 'duration' => '3 Hrs',
                'features' => ['Pickup 6am', 'Breakfast Fruits', '3 Hrs', 'Swimming Equipments', 'Gopro Camera', 'Water Bottles', 'Fishing, Jumping Fishing'],
            ],
            [
                'name' => 'Discovery scuba diving DSD', 'price' => 80, 'image' => 'img/price-10.jpg', 'show_on_home' => true,
                'pickup_time' => '8 AM / 2 PM', 'duration' => '3 Hrs',
                'features' => ['Pickup 8am 2pm and Drop', 'Breakfast Fruits', '3 hrs ~ 2 Diving Shallow Water Training 8 Meters 2nd Diving 15 Meters', 'Swimming Equipments', 'Gopro Camera', 'Water Bottles'],
            ],
            ['name' => 'Front Diving', 'price' => null, 'image' => null, 'show_on_home' => false, 'features' => []],
            ['name' => 'Reef Diving', 'price' => null, 'image' => null, 'show_on_home' => false, 'features' => []],
        ];

        foreach ($packages as $index => $data) {
            Package::create(array_merge([
                'slug'       => Str::slug($data['name']),
                'is_active'  => true,
                'sort_order' => ($index + 1) * 10,
            ], $data));
        }
    }
}
