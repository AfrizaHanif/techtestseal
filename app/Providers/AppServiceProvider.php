<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //CONSUME EXTERNAL API (GET) FOR HEADER AND FOOTER AS NAVIGATION
        $response = Http::get('https://api-berita-indonesia.vercel.app/');

        // CHECK API RESPONSE
        if($response->successful()){
            // DECODING JSON WITH SETTING UP COLUMN AND SHUFFLE (RANDOM AND EXPLORE)
            $endpoint = $this->getSource(json_decode($response, true)['endpoints']);

            // NAVIGATION (HEADER)
            $navJson = array_column($endpoint, 'name'); // COMPACT

            // EXPLORE (FOOTER) (SOURCE)
            $exploreSourceJson = array_column($endpoint, 'name');
            shuffle($exploreSourceJson);
            $exploreSource = array_slice($exploreSourceJson, 0, 5); // COMPACT

            // EXPLORE (FOOTER) (CATEGORY)
            $exploreCategoryJson = array_column($endpoint[0]['paths'], 'name');
            shuffle($exploreCategoryJson);
            $exploreCategory = array_slice($exploreCategoryJson, 0, 5); // COMPACT

            // SHARE VARIABLE TO VIEW
            View::share('navJson', $navJson);
            View::share('exploreSource', $exploreSource);
            View::share('exploreCategory', $exploreCategory);
        }else{
            View::share('navJson', null);
            View::share('exploreSource', null);
            View::share('exploreCategory', null);
        }

        Paginator::useBootstrapFive();
    }

    function getSource($obj){
        // GET DATA
        $list = [];

        // LOOPING THE OBJECT (ARRAY)
        foreach ($obj as $key => $val){
            // ADD ITEM TO LIST
            $list[] = $val;
        }

        // CHECK IF THERE'S A RESULT
        if(count($list) >= 1){
            return $list;
        }else{
            return null;
        }
    }
}
