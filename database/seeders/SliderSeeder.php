<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slider::create([
            'title' => 'Fresh fruits<br>&vegetable',
            'sub_title' => 'Summer vage sale',
            'btn_text' => 'Shop now',
            'btn_link' => '#',
            'alignment' => 'left',
            'background' => '1686719425-1686476822-slider1.jpg',
        ]);
        Slider::create([
            'title' => 'Prod of indian<br>100% pacaging',
            'sub_title' => 'Organic indian masala',
            'btn_text' => 'Shop now',
            'btn_link' => '#',
            'alignment' => 'right',
            'background' => '1686719683-1686476853-slider2.jpg',
        ]);
        Slider::create([
            'title' => 'Fresh for your health',
            'sub_title' => 'Top selling!',
            'btn_text' => 'Shop now',
            'btn_link' => '#',
            'alignment' => 'center',
            'background' => '1686633967-1686477256-slider3.jpg',
        ]);
    }
}
