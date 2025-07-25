<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CounterItem;

class CounterItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $counter_item = new CounterItem();
        $counter_item->item1_number = '40';
        $counter_item->item1_text = 'Destinations';
        $counter_item->item2_number = '1200';
        $counter_item->item2_text = 'Clients Served';
        $counter_item->item3_number = '130';
        $counter_item->item3_text = 'Tours Completed';
        $counter_item->item4_number = '60';
        $counter_item->item4_text = 'Countries Visited';
        $counter_item->status = 'Show';
        $counter_item->save();
    }
}
