<?php
/**
 * Created by PhpStorm.
 * User: Miko
 * Date: 2017/3/16
 * Time: 11:27
 */
namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class TestTransformers extends TransformerAbstract
{
    /***
     * 分开为了解耦
     * 数据字段选择
     * @param $lesson
     * @return array
     */
    public function transform($lesson)
    {
        /******隐藏数据库字段*****/
        return [
            'username' => $lesson['title'],
            'article' => $lesson['content'],
        ];
    }
}