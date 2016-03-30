<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'HomeController@index')->name('home');

//后台登陆
Route::get('admin/login', 'Admin\AdminController@login')->name('admin.login');
Route::post('admin/login', 'Admin\AdminController@doLogin')->name('admin.login.do');

//微信H5页面
Route::get('follow', 'Wechat\ContentController@follow')->name('wechat.content.follow');//关注成功
Route::get('contact-us', 'Wechat\ContentController@contactUs')->name('wechat.content.contactus');//联系我们
Route::get('map', 'Wechat\ContentController@map')->name('wechat.content.map');//地点介绍
Route::get('meeting-agenda', 'Wechat\ContentController@meetingAgenda')->name('wechat.content.meetingagenda');//会议议程

//微信服务
Route::any('wechat/serve', 'Wechat\ServeController@serve');

//微信绑定证件号
Route::get('wechat/binding', 'Wechat\BindingController@index')->name('wechat.binding');//员工绑定微信号页面
Route::post('wechat/binding', 'Wechat\BindingController@doBind')->name('wechat.binding.do');//员工提交绑定微信号

Route::group(['middleware' => 'backend.auth'], function () {
    //后台维护
    Route::get('admin/logout', 'Admin\AdminController@doLogout')->name('admin.logout');
    Route::get('admin/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');

    //帮助中心
    Route::get('db/migrate/reset', 'Admin\HelpCenterController@migrateReset')->name('db.migrate.reset');//数据重置
    Route::get('cache/clear', 'Admin\HelpCenterController@clearCache')->name('cache.clear');//清空缓存
    Route::get('db/migrate', 'Admin\HelpCenterController@migrate')->name('db.migrate');//数据迁移。
    Route::get('db/seed', 'Admin\HelpCenterController@seed')->name('db.seed');//初始化数据。
    Route::get('admin/setting', 'Admin\HelpCenterController@appSetting')->name('admin.setting');//系统设置页面
    Route::get('admin/optimize', 'Admin\HelpCenterController@optimize')->name('admin.optimize');//执行优化操作

    //查看系统log
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('sys.log');

    //数据导入
    Route::get('import/employee', 'Admin\DataCenterController@importEmployee')->name('import.employee');//导入员工
    Route::get('import/employee-guest', 'Admin\DataCenterController@importEmployeeGuest')->name('import.employee.guest');//导入员工嘉宾
    Route::get('import/dealer', 'Admin\DataCenterController@importDealer')->name('import.dealer');//导入经销商
    Route::get('import/tester', 'Admin\DataCenterController@importTester')->name('import.tester');//导入测试数据


    //用户组
    Route::get('wechat/group/manage', 'Wechat\GroupController@index')->name('wechat.group.manage');
    Route::get('wechat/group/pull', 'Wechat\GroupController@pull')->name('wechat.group.pull');//从公众平台拉取group数据存入数据库
    Route::get('wechat/group/create', 'Wechat\GroupController@create')->name('wechat.group.create');
    Route::post('wechat/group/create', 'Wechat\GroupController@store')->name('wechat.group.create.do');
    Route::post('wechat/group/delete/{id}', 'Wechat\GroupController@destroy')->name('wechat.group.delete');//删除页面
    Route::get('wechat/group/edit/{id}', 'Wechat\GroupController@edit')->name('wechat.group.edit');
    Route::post('wechat/group/edit/{id}', 'Wechat\GroupController@update')->name('wechat.group.edit.do');

    //微信事件处理
    Route::get('wechat/event/manage', 'Wechat\EventController@index')->name('wechat.event.manage');//维护页面
    Route::get('wechat/event/edit/{id}', 'Wechat\EventController@edit')->name('wechat.event.edit');//编辑页面
    Route::post('wechat/event/edit/{id}', 'Wechat\EventController@update')->name('wechat.event.edit.do');//提交编辑页面
    Route::get('wechat/event/create', 'Wechat\EventController@create')->name('wechat.event.create');//新增页面
    Route::post('wechat/event/create', 'Wechat\EventController@store')->name('wechat.event.create.do');//提交新增页面
    Route::post('wechat/event/delete/{id}', 'Wechat\EventController@destroy')->name('wechat.event.delete');//删除页面

    //自定义菜单维护
    Route::any('wechat/menu/manage', 'Wechat\MenuController@manage')->name('wechat.menu.manage');//菜单维护
    Route::get('wechat/menu/bak', 'Wechat\MenuController@menuBak')->name('wechat.menu.bak');//备份公众号菜单
    Route::get('wechat/menu/delete', 'Wechat\MenuController@destroyFromWechat')->name('wechat.menu.delete');//删除公众号菜单
    Route::post('wechat/menu/push', 'Wechat\MenuController@pushToWechat')->name('wechat.menu.push');//提交菜单到公众号
    Route::get('wechat/menu/edit/{id}', 'Wechat\MenuController@edit')->name('wechat.menu.edit');//编辑页面
    Route::post('wechat/menu/edit/{id}', 'Wechat\MenuController@update')->name('wechat.menu.edit.do');//提交编辑页面
    Route::get('wechat/menu/create', 'Wechat\MenuController@create')->name('wechat.menu.create');//新增页面
    Route::post('wechat/menu/create', 'Wechat\MenuController@store')->name('wechat.menu.create.do');//提交新增页面
    Route::post('wechat/menu/delete/{id}', 'Wechat\MenuController@delete')->name('wechat.menu.delete');//删除页面
    Route::get('wechat/menu/pull', 'Wechat\MenuController@pull')->name('wechat.menu.pull');//从公众号上拉取菜单到DB

    //微信用户管理
    Route::get('wechat/user/list/{id}', 'Wechat\UserController@query')->name('wechat.user.list');//分页显示用户信息
    Route::get('wechat/user/fetch', 'Wechat\UserController@fetch')->name('wechat.user.fetch');//从公众号上拉取关注用户到DB

    //员工管理
    Route::get('wechat/employee/list/{id}', 'Wechat\EmployeeController@query')->name('wechat.employee.list');//分页显示用户信息
    Route::post('import/search/{id}', 'Admin\DataCenterController@search')->name('import.search');//搜索
    Route::get('wechat/employee/fetch', 'Wechat\UserController@fetch')->name('wechat.employee.fetch');//从公众号上拉取关注用户到DB
    Route::get('wechat/employee/edit/{id}', 'Admin\DataCenterController@edit')->name('wechat.employee.edit');//编辑页面
    Route::post('wechat/employee/edit/{id}', 'Admin\DataCenterController@update')->name('wechat.employee.edit.do');//提交编辑页面
    Route::post('wechat/employee/delete/{id}', 'Admin\DataCenterController@delete')->name('wechat.employee.delete');//删除页面
    Route::get('wechat/employee/create', 'Admin\DataCenterController@create')->name('wechat.employee.create');//新增页面
    Route::post('wechat/employee/create', 'Admin\DataCenterController@store')->name('wechat.employee.create.do');//提交新增页面


    //个性化菜单维护
    Route::any('wechat/menu/group/manage', 'Wechat\GroupMenuController@index')->name('wechat.menu.group.manage');//个性化自定义菜单维护
    Route::get('wechat/relation_messages', 'Wechat\MessageController@relation');
    Route::get('wechat/add_relation_messages', 'Wechat\MessageController@add');
    Route::post('wechat/add_user', 'Wechat\MessageController@add_user');
    Route::post('wechat/delete_user', 'Wechat\MessageController@delete_user');
    Route::get('wechat/edit_user/{id}', 'Wechat\MessageController@edit_user');
    Route::post('wechat/edit_save', 'Wechat\MessageController@edit_save');
    Route::post('wechat/vali', 'Wechat\MessageController@vali');

    Route::get('wechat/test', 'Wechat\EventController@show');//测试

    #微信墙
    Route::get('wechat/wechatwall', 'Marketing\WechatwallController@index')->name('walllist');
    Route::get('wechat/wechatwalledit', 'Marketing\WechatwallController@create')->name('walledit');
    Route::post('wechat/wechatwalledit', 'Marketing\WechatwallController@update')->name('wallupdate');
    Route::get('wechat/{id}/wechatwallpage', 'Marketing\WechatwallController@page')->name('wallpage');//h5页面
});
