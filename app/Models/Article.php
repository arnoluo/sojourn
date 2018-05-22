<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public static function createArticle($params)
    {
        if ($article = Article::checkUniqueId($params['uniqueId'])) {
            return $article->id;
        }

        return Article::insertGetId($params);
    }

    public static function checkUniqueId($uniqueId)
    {
        return Article::where('uniqueId', $uniqueId)->first();
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'article_tags', 'docId', 'tagId')
            ->withPivot('score');
    }
}