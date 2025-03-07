<?php

namespace App\Providers;

use App\Setting;
use App\Language;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
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
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        if (!app()->runningInConsole()  && file_exists(storage_path('installed'))) {
            // Share settings
            if (Cache::get('system_settings') && Cache::get('system_settings') != null) {
                $system_settings = Cache::get('system_settings');
            } else {
                $system_settings_info = Setting::where('settings_name', 'System Settings')->first();
                $system_settings = json_decode($system_settings_info->content, true);
                Cache::put('system_settings', $system_settings);
            }
            if (Cache::get('general_settings') && Cache::get('general_settings') != null) {
                $general_settings = Cache::get('general_settings');
            } else {
                $system_settings_info = Setting::where('settings_name', 'General Settings')->first();
                $general_settings = json_decode($system_settings_info->content, true);
                Cache::put('general_settings', $general_settings);
            }
            View::share('general_settings', $general_settings);
            View::share('system_settings', $system_settings);

            if ($system_settings['is_rtl'] == 'Yes') {
                $is_rtl = 1;
            } else {
                $is_rtl = 0;
            }
            View::share('is_rtl', $is_rtl);

            // For language support
            view()->composer('*', function ($view) {
                if (auth()->check()) {
                    $language = auth()->user()->language;
                    $language = ($language) ? $language : Cache::get('default_language');
                    if ($language) {
                        App::setLocale($language->code);
                    } else {
                        App::setLocale('main');
                    }
                } else {
                    App::setLocale('main');
                }
            });
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
