<?php

/*
 * This file is part of PHP CS Fixer.
 *
 * (c) WYT <cnwyt@outlook.com>
 *
 * MIT LICENSE.
 */

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function index()
    {
        return $this->about();
    }

    public function about()
    {
        $data = [];

        return view('default.about.about', $data);
    }

    public function contact()
    {
        $data = [];

        return view('default.about.contact', $data);
    }

    public function disclaimer()
    {
        $data = [];

        return view('default.about.disclaimer', $data);
    }

    public function join()
    {
        $data = [];

        return view('default.about.join', $data);
    }

    public function feedback()
    {
        $data = [];
        $data['seo'] = [
            'title' => '关于我们'.'-'.config('options.sitename'),
            'keywords' => '关键词',
            'description' => '',
        ];

        return view('default.about.feedback', $data);
    }

    public function feedbackCreate(Request $request)
    {
        if (null !== $request->input('isSubmit')) {
            $input = [];
            $input['type'] = 101;
            $input['uid'] = 0;
            $input['username'] = 0;
            $input['ip_address'] = '';
            $input['content'] = $request->input('content');
            $input['contact_info'] = $request->input('contact_info');
            $input['browser'] = '';
            $input['platform'] = '';
            $input['device'] = '';
            $input['user_agent'] = isset($_SERVER['HTTP_USER_AGENT']) ? ($_SERVER['HTTP_USER_AGENT']) : '';
            $input['created_at'] = date('Y-m-d H:i:s');
            $input['updated_at'] = date('Y-m-d H:i:s');

//            $table = (new FeedbackModel)->saveData(collect($input));
            DB::table('ks_feedback')->insert($input);

            return response([
                'code' => 200,
                'msg' => '',
            ], 200);
        }
    }
}
