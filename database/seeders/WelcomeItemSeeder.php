<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WelcomeItem;

class WelcomeItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obj = new WelcomeItem();
        $obj->heading = 'Welcome to Our Travel Agency';
        $obj->description = 'Explore the world with us. We offer the best travel packages tailored to your needs. <br> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum..';
        $obj->button_text = 'Learn More';
        $obj->button_link = '#';
        $obj->photo = 'about-1.jpg';
        $obj->video = 'S4DI3Bve_bQ';
        $obj->status = 'Show';
        $obj->save();
    }
}
