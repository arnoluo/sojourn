<?php

namespace App\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Models\Data;
use App\Services\View;
use App\Repositories\TagRepo;

class TagController extends BaseController
{
    public function index()
    {
        return View::make('home')->render();
    }
    public function article()
    {
        return View::make('article')->render();
    }

    public function createTag()
    {
        $content = isset($_GET['content']) ? (string)$_GET['content'] : '';
        if (empty($content)) {
            return json_encode(['result' => 'error', 'msg' => 'content empty!']);
        }

        $tagRepo = new TagRepo();
        if ($data = $tagRepo->getResponse($content)) {
            $docId = Tag::createTag($data);
            return ['result' => 'success', 'docId' => $docId];
        }

        return ['result' => 'error', 'detail' => $data];
    }

    public function batchTaging()
    {
        $articleData = Data::where('deleted', 0)->get();
        $tagRepo = new TagRepo();
        $docId = [];
        foreach ($articleData as $article) {
            if ($data = $tagRepo->getResponse($article['body_value'])) {
                $docId[] = Tag::createTag($data, $article['entity_id']);
            }
        }

        return ['result' => 'success', 'docId' => $docId];
    }

    public function getTag()
    {
        if (!isset($_GET['docId'])) {
            return json_encode(['result' => 'error', 'msg' => 'doc id not found!']);
        }

        $article = Article::find($_GET['docId']);
        if (empty($article)) {
            return json_encode(['result' => 'error', 'msg' => 'doc does not exit!']);
        }

        $article['tags'] = $article->tags()->get()->toArray();

        return ['result' => 'success', 'data' => $article];
    }

    public function getAll()
    {
        $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
        $size = isset($_GET['size']) ? $_GET['size'] : 10;
        $articles = Article::where('entity_id', '!=', 0)
            ->skip($offset * $size)
            ->take($size)
            ->get();
        foreach($articles as $key => $article) {
            $articles[$key]['tags'] = $article->tags()->get()->toArray();
        }

        return ['result' => 'success', 'data' => $articles];
    }
}