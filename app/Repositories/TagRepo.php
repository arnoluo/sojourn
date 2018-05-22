<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Services\View;
use \Ixudra\Curl\CurlService as CurlService;

class TagRepo
{

    public function getResponse($content)
    {

        $calais_url = 'https://api.thomsonreuters.com/permid/calais';
        $token = '4reAFg0Azd40DrFa8GAPpi8AA4bVyrMP';

        $headers = [
            "X-AG-Access-Token: $token",
            'Content-Type: text/raw',
            'outputFormat: application/json',
            'Accept: application/json'
        ];
        $curl = new CurlService();
        $response = $curl->to($calais_url)->withHeaders($headers)->withData($content)->post();
        $data = json_decode($response, true);
        //return $data;exit();

        if (is_array($data) && isset($data['doc'])) {
            return $data;
        }

        return false;
    }
}