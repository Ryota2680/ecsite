<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 管理画面用のクッキー名称、セッションテーブル名を変更する
        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        //これだとアドミンログイン後にセッションがなくなり、永遠にループしてしまう
        // if ($uri == '/terui145/laravel_new/public/admin/login') {
        //     config([
        //         'session.cookie' => config('const.session_cookie_admin'),
        //     ]);
        // }
        
        //URLに"admin"が含まれる場合、
        if (strstr($uri, '/admin/') !== false || $uri === '/admin/login') {
            config([
                // 'SESSION_COOKIE_ADMIN',
                'session.cookie' => config('const.session_cookie_admin'),
                str_slug(env('APP_NAME', 'laravel'), '_').'_admin_session'
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
