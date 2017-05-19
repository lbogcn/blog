<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\DenyKeyword;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    /**
     * 发表留言
     * @param Request $request
     */
    public function store(Request $request)
    {
        $this->trimInput(['nickname', 'email', 'captcha']);
        $this->multiSpace(['content']);

        \Validator::extend('deny_keyword', function($attribute, $value, $parameters) {
            $keywords = array_column(DenyKeyword::select('keyword')->get()->toArray(), 'keyword');
            if (empty($keywords)) {
                return true;
            }

            $filterList = '/' . implode('|', $keywords) . '/i';
            return !preg_match_all($filterList, $value);
        });

        $this->validate($request, array(
            'content' => ['required', 'max:200', 'deny_keyword'],
            'nickname' => ['required', 'max:16'],
            'email' => ['required', 'max:32', 'email'],
            'captcha' => ['required', 'captcha'],
        ), array(
            'email.email' => '请输入合法邮箱'
        ));

        $user = User::findByEmailOrCreate($request->input('email'), $request->only(['email', 'nickname']));

        Message::create([
            'user_id' => $user->id,
            'ip' => $request->getClientIp(),
            'content' => str_replace(["\r\n", "\r"], "\n", $request->input('content'))
        ]);
    }

}