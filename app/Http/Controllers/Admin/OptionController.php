<?php

namespace app\Http\Controllers\Admin;

use App\Components\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{

    /**
     * 列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = array(
            'paginate' => Option::paginate(),
        );

        return view('admin.option.index', $data);
    }

    /**
     * 新增
     * @param Request $request
     * @return ApiResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'option_name' => ['required', 'unique:options', 'max:100'],
            'remark' => ['required'],
            'option_value' => ['required'],
        ));

        Option::create($request->only(['option_name', 'remark', 'option_value']));

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
            'option_name' => ['required', "unique:options,option_name,{$id}", 'max:100'],
            'remark' => ['required'],
            'option_value' => ['required'],
        ));

        $data = $request->only(['option_name', 'remark', 'option_value']);

        Option::updateById($id, $data);

        return ApiResponse::buildFromArray();
    }

}