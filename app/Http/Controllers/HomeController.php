<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){
        // CONSUME EXTERNAL API
        $nav_response = Http::get('https://api-berita-indonesia.vercel.app/');

        // CHECK API RESPONSE
        if($nav_response->successful()){
            // DECODING JSON WITH SETTING UP COLUMN AND SHUFFLE (RANDOM AND EXPLORE)
            $navJson = array_column($this->getSource(json_decode($nav_response, true)['endpoints']), 'name');
            $randomJson = $navJson;
            shuffle($randomJson);
            $exploreJson = $navJson;
            shuffle($exploreJson);

            // SLICING THE ARRAY TO SPECIFIC LIMIT
            $random = array_slice($randomJson, 0, 1);
            $explore = array_slice($exploreJson, 0, 5);
        }elseif($nav_response->failed()){
            if($nav_response->clientError()){

            }elseif($nav_response->serverError()){

            }
        }else{

        }

        // RETURN TO VIEW
        return view('pages.index', compact([
            'navJson',
            'random',
            'explore',
        ]));
    }

    public function redirect(Request $request, $source){
        // GET DATA
        $search = $request->input('search');
        // $all_posts = [];
        $selected_source = $source;

        // CONSUME EXTERNAL API FOR NAVIGATION
        $nav_response = Http::get('https://api-berita-indonesia.vercel.app/');

        // CHECK API RESPONSE
        if($nav_response->successful()){
            // DECODING JSON FOR SOURCE AND NAVIGATION
            $sourceJson = $this->searchSource(json_decode($nav_response, true)['endpoints'], $source);
            $navJson = array_column($this->getSource(json_decode($nav_response, true)['endpoints']), 'name');

            // dd($sourceJson);
            $all_posts = $this->getAllPosts($sourceJson, $source);
            // dd($all_posts);

            // dd(array_count_values(array_column($all_posts, 'category'))['terbaru']);

            // LOOPING FOR GET ALL POSTS (MOVE TO EXTERNAL FUNCTION (getAllPosts))
            // foreach($sourceJson[0]['paths'] as $source_key => $source_value){
            //     // CONSUME EXTERNAL API FOR POSTS IN SPECIFIC SOURCE AND EVERY CATEGORIES
            //     $response = json_decode(Http::get('https://api-berita-indonesia.vercel.app/'.$source.'/'.$source_value['name']), true);
            //     // dd(count($response['data']['posts']));

            //     // CHECK IF NO DATA IN CATEGORY
            //     if ($response !== null && isset($response['data']['posts'])) {
            //         // ADD CATEGORY AND ID TO ARRAY
            //         foreach($response['data']['posts'] as $res_key => $res_value){
            //             $response['data']['posts'][$res_key]['category'] = $source_value['name'];
            //             $response['data']['posts'][$res_key]['id'] = $res_key;
            //         }

            //         // MERGE ARRAY DURING LOOPING
            //         $all_posts = array_merge($all_posts, $response['data']['posts']);
            //     }
            //     // dd($all_posts);

            //     // array_push($all_posts, ['category' => $source_value['name']]);
            //     // $all_posts[] = $source_value['name'];

            //     // $response['data']['posts']['category'] = $source_value['name'];
            //     // $all_posts = array_merge($all_posts, $response['data']['posts']);
            // }

            // dd($all_posts);
            // $column = array_column(array_column($all_posts, 'data'), 'posts');

            // IF SEARCH AVAILABLE
            if($search){
                // LAUNCH FUNCTION TO SEARCH TITLE
                $searchJson = $this->searchJson($all_posts, $search);

                // LAUNCH FUNCTION TO PAGINATE ALL POSTS
                $recommends = $this->paginate($searchJson);
            }else{
                // LAUNCH FUNCTION TO PAGINATE ALL POSTS
                $recommends = $this->paginate($all_posts);
            }

            // SHUFFLE THE ARRAY FOR PICKING A RANDOM ITEMS
            $headlineJson = $all_posts;
            shuffle($headlineJson);
            $popularJson = $all_posts;
            shuffle($popularJson);
            $exploreJson = array_column($sourceJson[0]['paths'], 'name');
            shuffle($exploreJson);

            // SLICING THE ARRAY TO SPECIFIC LIMIT
            $headlines = array_slice($headlineJson, 0, 5);
            $populars = array_slice($popularJson, 0, 3);
            $explore = array_slice($exploreJson, 0, 5);

            // CHECK AMOUNT OF POST IN EVERY CATEGORIES
            $check_category = array_count_values(array_column($all_posts, 'category'));

            // VERIFY IF POSTS NOT AVAILABLE (NULL)
            if(count($all_posts) == 0){
                $error = 'Tidak ada postingan dari sumber tersebut. Mohon untuk mengunjungi sumber ini beberapa saat lagi';

                return view('pages.empty', compact([
                    'navJson',
                    'explore',
                    'sourceJson',
                    'selected_source',
                    'check_category',
                    'error',
                ]));
            }
        }elseif($nav_response->failed()){
            if($nav_response->clientError()){

            }elseif($nav_response->serverError()){

            }
        }else{

        }

        // RETURN TO VIEW
        return view('pages.redirect', compact([
            'search',
            'sourceJson',
            'selected_source',
            'navJson',
            'exploreJson',
            'all_posts',
            'recommends',
            'headlines',
            'populars',
            'explore',
            'check_category',
        ]));
    }

    public function source(Request $request, $source, $category){
        // GET DATA
        $search = $request->input('search');
        $selected_source = $source;
        $selected_category = $category;

        // CONSUME EXTERNAL API
        $response = Http::get('https://api-berita-indonesia.vercel.app/'.$source.'/'.$category);
        $nav_response = Http::get('https://api-berita-indonesia.vercel.app/');

        // CHECK API RESPONSE
        if($response->successful()){
            // DECODING JSON WITH LAUNCH A FUNCTION (SEARCH, CATEGORY, AND NAVIGATION)
            $responseArray = json_decode($response, true);
            $jsonData = [];
            if (
                is_array($responseArray) &&
                isset($responseArray['data']) &&
                isset($responseArray['data']['posts'])
            ){
                $jsonData = $responseArray['data']['posts'];
            }

            $sourceJson = $this->searchSource(json_decode($nav_response, true)['endpoints'], $source);
            $navJson = array_column($this->getSource(json_decode($nav_response, true)['endpoints']), 'name');

            $all_posts = $this->getAllPosts($sourceJson, $source);

            // ADD ID FROM INDEX KEY TO ARRAY
            foreach($jsonData as $res_key => $res_value){
                $jsonData[$res_key]['id'] = $res_key;
            }
            // dd($jsonData);

            // IF SEARCH AVAILABLE
            if($search){
                // LAUNCH FUNCTION TO SEARCH TITLE
                $searchJson = $this->searchJson($jsonData, $search);

                // LAUNCH FUNCTION TO PAGINATE ALL POSTS
                $recommends = $this->paginate($searchJson);
            }else{
                // LAUNCH FUNCTION TO PAGINATE ALL POSTS
                $recommends = $this->paginate($jsonData);
            }

            // SHUFFLE THE ARRAY FOR PICKING A RANDOM ITEMS
            $headlineJson = $jsonData;
            shuffle($headlineJson);
            $popularJson = $jsonData;
            shuffle($popularJson);
            $exploreJson = array_column($sourceJson[0]['paths'], 'name');
            shuffle($exploreJson);

            // SLICING THE ARRAY
            $headlines = array_slice($headlineJson, 0, 5);
            $populars = array_slice($popularJson, 0, 3);
            $explore = array_slice($exploreJson, 0, 5);

            // CHECK AMOUNT OF POST IN EVERY CATEGORIES
            $check_category = array_count_values(array_column($all_posts, 'category'));

            // VERIFY IF POSTS NOT AVAILABLE (NULL)
            if(count($jsonData) == 0){
                $error = 'Tidak ada postingan dari kategori di sumber tersebut. Mohon untuk mengunjungi kategori ini beberapa saat lagi';

                return view('pages.empty', compact([
                    'navJson',
                    'explore',
                    'sourceJson',
                    'selected_source',
                    'error',
                    'check_category',
                ]));
            }
        }elseif($response->failed()){
            if($response->clientError()){

            }elseif($response->serverError()){

            }
        }else{

        }

        // RETURN TO VIEW
        return view('pages.source', compact([
            'search',
            'selected_source',
            'selected_category',
            'sourceJson',
            'navJson',
            'recommends',
            'headlines',
            'populars',
            'explore',
            'check_category',
        ]));
    }

    public function post(Request $request, $source, $category, $index){
        // GET DATA
        $selected_source = $source;
        $selected_category = $category;
        $selected_index = $index;

        // CONSUME EXTERNAL API
        $response = Http::get('https://api-berita-indonesia.vercel.app/'.$source.'/'.$category);
        $nav_response = Http::get('https://api-berita-indonesia.vercel.app/');

        // CHECK API RESPONSE
        if($response->successful()){
            // DECODING JSON WITH LAUNCH A FUNCTION (SEARCH AND NAVIGATION)
            $sourceJson = $this->searchSource(json_decode($nav_response, true)['endpoints'], $source);
            $navJson = array_column($this->getSource(json_decode($nav_response, true)['endpoints']), 'name');
            // $jsonData = json_decode($response, true)['data']['posts'][$index];
            $responseArray = json_decode($response, true);
            $jsonData = null;
            // $jsonData1 = json_decode($response, true)['data']['posts'];

            if(
                is_array($responseArray) &&
                isset($responseArray['data']['posts']) &&
                isset($responseArray['data']['posts'][$index])
            ){
                $jsonData = $responseArray['data']['posts'][$index];
            }

            $all_posts = $this->getAllPosts($sourceJson, $source);
            // dd($all_posts);

            // SHUFFLE THE ARRAY FOR PICKING A RANDOM ITEMS
            $popularJson = $all_posts;
            shuffle($popularJson);
            $relatedJson = $all_posts;
            shuffle($relatedJson);
            $exploreJson = array_column($sourceJson[0]['paths'], 'name');
            shuffle($exploreJson);

            // SLICING THE ARRAY
            $populars = array_slice($popularJson, 0, 3);
            $related = array_slice($relatedJson, 0, 3);
            $explore = array_slice($exploreJson, 0, 5);

            // CHECK AMOUNT OF POST IN EVERY CATEGORIES
            $check_category = array_count_values(array_column($all_posts, 'category'));

            // VERIFY IF POST NOT AVAILABLE (NULL)
            if(!$jsonData){
                $error = 'Tidak ada postingan yang terdaftar';

                return view('pages.empty', compact([
                    'navJson',
                    'explore',
                    'sourceJson',
                    'selected_source',
                    'error',
                    'check_category',
                ]));
            }
        }elseif($response->failed()){
            if($response->clientError()){

            }elseif($response->serverError()){

            }
        }else{

        }

        // RETURN TO VIEW
        return view('pages.post', compact([
            'selected_source',
            'selected_category',
            'selected_index',
            'sourceJson',
            'navJson',
            'jsonData',
            'populars',
            'related',
            'explore',
            'check_category',
        ]));
    }

    // FOR PAGINATE ALL POSTS
    public function paginate($items, $perPage = 8, $page = null, $options = []){
        // SETTING UP FOR PAGINATION
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $options = [
            'path' => Paginator::resolveCurrentPath()
        ];

        // RETURN TO FUNCTION
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    // FOR SEARCH ANY POST WITHIN CRITERIA
    function searchJson($obj, $value){
        // GET DATA
        $list = [];

        // CONVERT TEXT TO LOWERCASE
        $search_value = strtolower($value);

        // LOOPING THE OBJECT (ARRAY)
        foreach ($obj as $key => $val){
            // CHECK IF SEARCH VALUE AND TITLE PARTIALLY MATCH
            if (strpos(strtolower($val['title']), $search_value) !== FALSE){
                // ADD ITEM TO LIST
                $list[] = $val;
            }
        }

        // CHECK IF THERE'S A RESULT
        if(count($list) >= 1){
            return $list;
        }else{
            return null;
        }
    }

    // FOR SEARCH ANY CATEGORY WITHIN SOURCE
    function searchSource($obj, $value){
        // GET DATA
        $list = [];

        // CONVERT TEXT TO LOWERCASE
        $search_value = strtolower($value);

        // LOOPING THE OBJECT (ARRAY)
        foreach ($obj as $key => $val){
            // CHECK IF SEARCH VALUE AND TITLE FULLY MATCH
            if(strtolower(($val['name']) === $search_value)){
                // ADD ITEM TO LIST
                $list[] = $val;
            }
        }

        // CHECK IF THERE'S A RESULT
        if(count($list) >= 1){
            return $list;
        }else{
            return null;
        }
    }

    // TO GET ALL SOURCE FOR NAVIGATION
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

    // TO GET ALL POSTS
    function getAllPosts($pathJson, $source){
        // $pathJson = json_decode($response, true)['endpoints'];
        $all_posts = [];

        foreach($pathJson[0]['paths'] as $path_key => $path_value){
            $sourceJson = json_decode(Http::get('https://api-berita-indonesia.vercel.app/'.$source.'/'.$path_value['name']), true);

            if ($sourceJson !== null && isset($sourceJson['data']['posts'])) {
                // ADD CATEGORY AND ID TO ARRAY
                foreach($sourceJson['data']['posts'] as $source_key => $source_value){
                    $sourceJson['data']['posts'][$source_key]['category'] = $path_value['name'];
                    $sourceJson['data']['posts'][$source_key]['id'] = $source_key;
                }

                // MERGE ARRAY DURING LOOPING
                $all_posts = array_merge($all_posts, $sourceJson['data']['posts']);
            }
        }

        return $all_posts;
    }
}
