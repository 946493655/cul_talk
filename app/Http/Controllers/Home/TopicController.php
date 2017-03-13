<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiTalk\ApiTopic;
use Illuminate\Http\Request;
use Session;

class TopicController extends BaseController
{
    /**
     * 专栏
     */

    public function index()
    {
        $apiTopic = ApiTopic::index(100);
        if ($apiTopic['code']!=0) {
            echo "<script>alert('".$apiTopic['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'datas' => $apiTopic['data'],
        ];
        return view('home.topic.index', $result);
    }

    public function create()
    {
        if (!Session::has('user')) { return redirect(DOMAIN.'login'); }
        return view('home.topic.create');
    }

    public function store(Request $request)
    {
        if (!Session::has('user')) { return redirect(DOMAIN.'login'); }
        $data = [
            'name'  =>  $request->name,
            'intro' =>  $request->name,
            'uid'   =>  Session::get('user.uid'),
        ];
        $apiTopic = ApiTopic::add($data);
        if ($apiTopic['code']!=0) {
            echo "<script>alert('".$apiTopic['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'topic');
    }
}