<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public static $allowTypeGroup = [
        'topics',
        'language',
        'socialTag',
        'industry',
        'entities',
        'relations'
    ];

    public static $scoreName = [
        'topics' => 'score',
        'socialTag' => 'importance',
        'industry' => 'relevance',
        'entities' => 'relevance',
    ];

    public static function createTag($params, $entityId = 0)
    {
        if (empty($params)) {
            return false;
        }

        $doc = $params['doc']['info'];
        unset($params['doc']);
        $articleField = [
            'uniqueId' => $doc['docId'],
            'entity_id' => $entityId,
            'content' => $doc['document']
        ];

        $articleId = Article::createArticle($articleField);
        Tag::checkAndCreateTag($articleId, $params);

        return $articleId;
    }

    public static function checkAndCreateTag($docId, $params)
    {
        $tagField = [];
        $articleTagField['docId'] = $docId;
        foreach ($params as $param) {
            
            $tagField['typeGroup'] = $param['_typeGroup'];
            if (!in_array($tagField['typeGroup'], self::$allowTypeGroup, true)) {
                continue;
            }

            if (isset($param['_type'])) {
                $tagField['type'] = $param['_type'];
            }

            if ($tagField['typeGroup'] === 'language') {
                $tagField['name'] = str_replace('http://d.opencalais.com/lid/DefaultLangId/', '', $param['language']);
            } else {
                $tagField['name'] = $param['name'];
            }

            $articleTagField['tagId'] = Tag::checkTagGetId($tagField);

            $score = 0;
            if (in_array($tagField['typeGroup'], array_keys(self::$scoreName))) {
                $score = $param[self::$scoreName[$tagField['typeGroup']]];
                if ($tagField['typeGroup'] == 'socialTag') {
                    switch ($score) {
                        case 1:
                            $score = 1;
                            break;
                        case 2:
                            $score = 0.66;
                            break;
                        case 3:
                            $score = 0.33;
                    }
                }
            }
            ArticleTag::createArticleTag($articleTagField, $score);
        }
    }

    public static function checkTagGetId($params)
    {
        if ($tag = Tag::getTag($params)) {
            return $tag->id;
        }

        return Tag::insertGetId($params);
    }

    public static function getTag($params)
    {
        return Tag::where($params)->first();
    }

    public function articles()
    {
        return $this->belongsToMany('App\Models\Article', 'article_tags', 'tagId', 'docId')
            ->withPivot('score');
    }
}