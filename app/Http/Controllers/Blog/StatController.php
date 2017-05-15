<?php

namespace App\Http\Controllers\Blog;

use App\Components\CacheName;
use App\Http\Controllers\Controller;
use App\Models\Article;

class StatController extends Controller
{

    /**
     * 统计PV
     * @param $id
     * @return string
     */
    public function pv($id)
    {
        $redis = \RedisClient::connection();
        $key = \Cache::getPrefix() . CacheName::STAT_PV[0];

        $count = $redis->hincrby($key, $id, 1);
        if ($count >= 100) {
            try {
                /** @var Article $article */
                $article = Article::findOrFail($id);
                if ($article) {
                    $article->pv += $count;
                    $article->saveOrFail();
                }
                $redis->hset($key, $id, 0);
            } catch (\Exception $e) {
            } catch (\Throwable $t) {
            }
        }

        return '';
    }

}