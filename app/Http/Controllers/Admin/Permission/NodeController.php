<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Components\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\AdminNode;
use App\Services\ImportNodeService;
use Illuminate\Http\Request;

/**
 * 节点管理
 * @nodeTitle 权限-节点管理
 * @node index 节点列表
 * @node store 保存节点
 * @node update 更新节点
 * @node destroy 删除节点
 * @node import 一键导入自动更新节点
 */
class NodeController extends Controller
{

    /**
     * 节点列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = array(
            'paginate' => AdminNode::paginate()
        );

        return view('admin.permission.node.index', $data);
    }

    /**
     * 保存
     * @param Request $request
     * @return ApiResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'node' => ['required', 'min:1', 'max:12'],
            'route' => ['max:255'],
        ));

        AdminNode::create($request->only(['node', 'route']));

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
        $model = AdminNode::findOrFail($id);

        $this->validate($request, array(
            'node' => ['required', 'min:1', 'max:12'],
            'route' => ['max:255'],
        ));

        $data = $request->only(['node', 'route']);
        $model->update($data);

        return ApiResponse::buildFromArray();
   }

    /**
     * 删除
     * @param $id
     * @return ApiResponse
     */
    public function destroy($id)
    {
        $model = AdminNode::findOrFail($id);

        \DB::beginTransaction();
        $model->delete();
        $model->roles()->detach();
        \DB::commit();

        return ApiResponse::buildFromArray();
    }

    /**
     * 一键导入自动更新节点
     * @param ImportNodeService $importNodeService
     * @return ApiResponse
     */
    public function import(ImportNodeService $importNodeService)
    {
        $importNodeService->handle();

        return ApiResponse::buildFromArray();
    }

}