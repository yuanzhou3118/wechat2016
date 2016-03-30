<?php

namespace App\Http\Controllers\Wechat;

use App\WechatGroupMenu;
use App\WechatGroupMenuItem;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GroupMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('wechat.groupmenu', ['button' => WechatGroupMenuItem ::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createmenu()
    {
        $wechat = app('wechat');
        $menu = $wechat->menu;

        $array = [];//定义数组
        $buttons = WechatMenuItem::where('id', '>', 0)->orderBy('sort_num')->get();

        $index = 0;
        $subIndex = 0;
        $id = 0;

        foreach ($buttons as $button) {
            if ($button->is_button)//顶级菜单
            {
                if ($id > 0)
                    $index++;

                $array[$index] = [];
                $array[$index]['name'] = $button->name;

                if (!empty($button->key))
                    $array[$index]['key'] = $button->key;

                if (!empty($button->type))
                    $array[$index]['type'] = $button->type;

                if (!empty($button->url))
                    $array[$index]['url'] = $button->url;

                if (WechatMenuItem::where('button_id', $button->id)->count() > 0)
                    $array[$index]['sub_button'] = [];

                $subIndex = 0;

                $id++;
            } else {

                $array[$index]['sub_button'][$subIndex] = [];
                $array[$index]['sub_button'][$subIndex]['name'] = $button->name;
                $array[$index]['sub_button'][$subIndex]['type'] = $button->type;

                if (!empty($button->url))
                    $array[$index]['sub_button'][$subIndex]['url'] = $button->url;

                if (!empty($button->key))
                    $array[$index]['sub_button'][$subIndex]['key'] = $button->key;

                $subIndex++;
            }
        }

        echo json_encode($array, JSON_UNESCAPED_UNICODE);


        //$matchRule = ['group_id' => '100', 'country' => '中国'];
        $menu->add($array);


    }
}
