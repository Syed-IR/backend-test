<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cats = [
          [
            "name" => "Arts"
          ],
          [
            "name" => "Automobiles"
          ],
          [
            "name" => "Movies"
          ],
          [
            "name" => "Business"
          ],
          [
            "name" => "Education"
          ],
          [
            "name" => "Fashion"
          ],
          [
            "name" => "Food"
          ],
          [
            "name" => "Health"
          ],
          [
            "name" => "Job Market"
          ],
          [
            "name" => "Magazine"
          ]
        ];

        $timestamp = Carbon::now();

        for ($i=0; $i < sizeof($cats); $i++) { 
          $cats[$i]['created_at'] = $timestamp;
          $cats[$i]['updated_at'] = $timestamp;
        }

        Category::insert($cats);
    }
}
