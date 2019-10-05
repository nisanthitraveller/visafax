<?php

namespace App\Models;

class Blog
{
    public function getFeeds() {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://visabadge.com/blog/feed/json');
        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getBody(), true);
        return $content;
        
    }
}
