<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    public static function createArticleTag($params, $score = 0)
    {
        if (ArticleTag::getArticleTag($params)) {
            return true;
        }

        $score = (int)($score * 100);
        if ($score != 0 && $score <= 100) {
            $params['score'] = $score;
        }

        return ArticleTag::insert($params);
    }

    public static function getArticleTag($params)
    {
        return ArticleTag::where($params)->first();
    }
}