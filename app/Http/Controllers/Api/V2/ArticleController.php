<?php

namespace App\Http\Controllers\Api\V2;

use App\Article;
use App\Transformers\TestTransformers;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests;

class ArticleController extends BaseController
{
    public function index(){
        $article = Article::all();
        //return $this->collection($article, new TestTransformers());
        return ['error'=>0,'msg'=>$article];
    }
}
