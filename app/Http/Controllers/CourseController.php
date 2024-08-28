<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CourseController extends Controller
{
    public function index(Request $request)
    {

    }

    public function crawl(Request $request){
        
    
        for($page_id = 1;$page_id < 100;$page_id++){
            $response = Http::withCookies(['sessionid' => 'rpc97fpolq3htxasm9honx9d2lyp3rw2'],'.git.ir')->get("https://git.ir/api/post/category-related-items/316311?page=$page_id");
            
            $document =  $response->body();
            
            $dom = new \DOMDocument();
                
            $dom->loadHTML($document);
            
            $links = $dom->getElementsByTagName('a');
            foreach($links as $link){
                        echo var_dump($link->getAttribute('href'));
            }
        }
    }
}
