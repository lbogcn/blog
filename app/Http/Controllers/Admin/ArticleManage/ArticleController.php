<?php

namespace App\Http\Controllers\Admin\ArticleManage;

use App\Components\ApiResponse;
use App\Components\Qiniu;
use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{

    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = array(
            'paginate' => Article::paginate(),
        );

        return view('admin.article-manage.article.index', $data);
    }

    /**
     * 写文章
     * @param Qiniu $qiniu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Qiniu $qiniu)
    {
        $callbackUrl = config('qiniu.callback_ueditor');
        $uploadToken = $qiniu->uploadToken($callbackUrl);

        $data = array(
            'navLocation' => action('\\' . self::class . '@index'),
            'uploadToken' => $uploadToken
        );

        return view('admin.article-manage.article.create', $data);
    }

    public function store()
    {
        return __FUNCTION__;
    }

    /**
     * 上架
     * @param $id
     * @return ApiResponse
     */
    public function up($id)
    {
        Article::up($id);

        return ApiResponse::buildFromArray();
    }

    /**
     * 下架
     * @param $id
     * @return ApiResponse
     */
    public function down($id)
    {
        Article::down($id);

        return ApiResponse::buildFromArray();
    }

    /**
     * 删除
     * @param $id
     * @return ApiResponse
     */
    public function destroy($id)
    {
        Article::del($id);

        return ApiResponse::buildFromArray();
    }

}