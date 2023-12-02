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
            "name" => "Autos"
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
            "name" => "Corrections"
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
            "name" => "Multimedia"
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
            "name" => "Opinion"
          ],
          [
            "name" => "Public Editor"
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
            "name" => "Style"
          ],
          [
            "name" => "T Magazine"
          ],
          [
            "name" => "T:Style"
          ],
          [
            "name" => "Technology"
          ],
          [
            "name" => "The Public Editor"
          ],
          [
            "name" => "The Upshot"
          ],
          [
            "name" => "Theater"
          ],
          [
            "name" => "Times Topics"
          ],
          [
            "name" => "TimesMachine"
          ],
          [
            "name" => "Topics"
          ],
          [
            "name" => "Travel"
          ],
          [
            "name" => "Universal"
          ],
          [
            "name" => "UrbanEye"
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
