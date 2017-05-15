<?php

namespace App\Http\Controllers\Admin;

use App\Components\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\Option;
use Illuminate\Http\Request;

class LinkController extends Controller
{

    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = array(
            'paginate' => Link::paginate(),
        );

        return view('admin.link.index', $data);
    }

    /**
     * 新增
     * @param Request $request
     * @return ApiResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'title' => ['required', 'max:16'],
            'url' => ['required', 'max:500', 'url'],
        ));

        Link::create($request->only(['title', 'url']));

        return ApiResponse::buildFromArray();
    }

    /**
     * 更新
     * @param Request $request
     * @param $id
     * @return ApiResponse
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'title' => ['required', 'max:16'],
            'url' => ['required', 'max:500', 'url'],
        ));

        $data = $request->only(['title', 'url']);

        Link::updateById($id, $data);

        return ApiResponse::buildFromArray();
    }

    /**
     * 删除
     * @param $id
     * @return ApiResponse
     */
    public function destroy($id)
    {
        Link::del($id);

        return ApiResponse::buildFromArray();
    }

}