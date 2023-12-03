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
            "name" => "Blogs"
          ],
          [
            "name" => "Books"
          ],
          [
            "name" => "Booming"
          ],
          [
            "name" => "Business"
          ],
          [
            "name" => "Crosswords & Games"
          ],
          [
            "name" => "Dining & Wine"
          ],
          [
            "name" => "Education"
          ],
          [
            "name" => "Fashion & Style"
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
            "name" => "Learning"
          ],
          [
            "name" => "Magazine"
          ],
          [
            "name" => "Movies"
          ],
          [
            "name" => "National"
          ],
          [
            "name" => "Obituaries"
          ],
          [
            "name" => "Olympics"
          ],
          [
            "name" => "Real Estate"
          ],
          [
            "name" => "Science"
          ],
          [
            "name" => "Sports"
          ],
          [
            "name" => "Technology"
          ],
          [
            "name" => "The Upshot"
          ],
          [
            "name" => "Theater"
          ],
          [
            "name" => "Travel"
          ],
          [
            "name" => "Universal"
          ],
          [
            "name" => "World"
          ],
        ];

        $timestamp = Carbon::now();

        for ($i=0; $i < sizeof($cats); $i++) { 
          $cats[$i]['created_at'] = $timestamp;
          $cats[$i]['updated_at'] = $timestamp;
        }

        Category::insert($cats);
    }
}
