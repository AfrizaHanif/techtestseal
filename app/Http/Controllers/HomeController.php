<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;



class HomeController extends Controller
{
    public function index(){
        $response = Http::get('https://api-berita-indonesia.vercel.app/');

        if($response->successful()){
            $jsonData = json_decode($response, true);
            // dd('Success', $heroes);
        }elseif($response->failed()){
            if($response->clientError()){

            }elseif($response->serverError()){

            }
        }else{

        }

        return view('pages.index', compact([
            'jsonData',
        ]));
    }

    public function redirect($source){
        $response = Http::get('https://api-berita-indonesia.vercel.app/'.$source.'/terbaru/');

        if($response->successful()){
            $jsonData = json_decode($response, true);
            // dd('Success', $jsonData['data']['posts']);
        }elseif($response->failed()){
            if($response->clientError()){

            }elseif($response->serverError()){

            }
        }else{

        }

        return view('pages.index', compact([
            'jsonData',
        ]));
    }

    public function source($source, $category){
        $response = Http::get('https://api-berita-indonesia.vercel.app/'.$source.'/'.$category);
        $selected_source = $source;
        $selected_category = $category;

        if($response->successful()){
            $jsonData = json_decode($response, true)['data']['posts'];
            $headlines = array_slice(json_decode($response, true)['data']['posts'], 0, 5);
            shuffle($headlines);
            $populars = array_slice(json_decode($response, true)['data']['posts'], 0, 3);
            shuffle($populars);
            // $headlines = array_slice($jsonData, 0, 5);
            // $populars = array_slice($jsonData, 0, 3);
            $recommends = $this->paginate($jsonData);

            // dd('Success', $recommends);
        }elseif($response->failed()){
            if($response->clientError()){

            }elseif($response->serverError()){

            }
        }else{

        }

        return view('pages.source', compact([
            'selected_source',
            'selected_category',
            'headlines',
            'populars',
            'recommends',
        ]));
    }

    public function post($source, $category, $index){
        $response = Http::get('https://api-berita-indonesia.vercel.app/'.$source.'/'.$category);
        $selected_source = $source;
        $selected_category = $category;
        $selected_index = $index;

        if($response->successful()){
            $jsonData = json_decode($response, true)['data']['posts'][$index];
            $populars = array_slice(json_decode($response, true)['data']['posts'], 0, 3);
            shuffle($populars);
            $related = array_slice(json_decode($response, true)['data']['posts'], 0, 3);
            shuffle($related);
            // dd('Success', $jsonData);
        }elseif($response->failed()){
            if($response->clientError()){

            }elseif($response->serverError()){

            }
        }else{

        }

        return view('pages.index', compact([
            'selected_source',
            'selected_category',
            'selected_index',
            'jsonData',
            'populars',
            'related',
        ]));
    }


    public function paginate($items, $perPage = 8, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $options = [
            'path' => Paginator::resolveCurrentPath()
        ];
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
