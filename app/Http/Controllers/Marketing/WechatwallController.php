<?php

namespace App\Http\Controllers\Marketing;

use App\WechatWall;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class WechatwallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('wechat.wechatwallmenu', ['walls' => WechatWall::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('wechat.wechatwall');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        //上传文件|| (($request->hasFile('logo')) & $logo->isValid())
        $file = $request->pic;
        //$logo = $request->logo;

        if ( $request->hasFile('pic') && $file -> isValid()) {
            $clientName = $file->getClientOriginalName();

            $tmpName = $file->getFileName(); // 缓存在tmp文件夹中的文件名 例如 php8933.tmp 这种类型的.

            $realPath = $file->getRealPath();    //这个表示的是缓存在tmp文件夹下的文件的绝对路径

            $entension = $file->getClientOriginalExtension(); //上传文件的后缀.

            $mimeTye = $file->getMimeType();//大家对mimeType应该不陌生了. 我得到的结果是 image/jpeg.

            $newName = md5(date('ymdhis') . $clientName) . "." . $entension;

            $path = $file->move('upload', $newName);

            //logo
//            $clientNames = $logo->getClientOriginalName();
//            $tmpNames = $logo->getFileName(); // 缓存在tmp文件夹中的文件名 例如 php8933.tmp 这种类型的.
//            $realPaths = $logo->getRealPath();    //这个表示的是缓存在tmp文件夹下的文件的绝对路径
//            $entensions = $logo->getClientOriginalExtension(); //上传文件的后缀.
//            $mimeTyes = $logo->getMimeType();//大家对mimeType应该不陌生了. 我得到的结果是 image/jpeg.
//            $newNames = md5(date('ymdhis') . $clientNames) . "." . $entensions;
//            $paths = $file->move('upload', $newNames);


            //上传文件end

            $myWechatWall = new WechatWall();

            $myWechatWall->theme = $request->theme;
            $myWechatWall->keyword = $request->keyword;
            $myWechatWall->title = $request->title;
//            $myWechatWall->logo = $request->logo;
            $myWechatWall->bg_img = $request->bg_img;
            $myWechatWall->tdcode = $path;
            $myWechatWall->save();
            $this->index();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function page($id)
    {
//        $id = $
        return view('wechat.wallpage',['wall'=>WechatWall::findOrFail($id)]);
    }
}
