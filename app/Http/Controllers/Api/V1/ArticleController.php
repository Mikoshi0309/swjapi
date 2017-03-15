<?php

namespace App\Http\Controllers\Api\V1;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests;

class ArticleController extends BaseController
{
    public function index(){
        $article = Article::all();
        return response()->json(['error'=>0,'msg'=>$article]);
    }
}
