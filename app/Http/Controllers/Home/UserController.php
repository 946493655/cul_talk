<?php
namespace App\Http\Controllers\Home;

class userController extends BaseController
{
    /**
     * 用户信息
     */
    public function index()
    {
        $result = [
            'users' => \Session::get('user'),
        ];
        return view('member.user.index', $result);
    }
}