<?php

namespace App\Providers;

use Schema;
use App\Models\SmtpSetting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (\Schema::hasTable('smtp_settings')) {
            $smtp = SmtpSetting::first();
            if ($smtp) {
                $data = [
                    'driver' => $smtp->mailer,
                    'host' => $smtp->host,
                    'port' => $smtp->port,
                    'username' => $smtp->username,
                    'password' => $smtp->password,
                    'encryption' => $smtp->encryption,
                    'from' => [
                        'address' => $smtp->from_address,
                        'name' => 'FarhaN Fahidur Rahim',
                    ]
                ];
                Config::set('mail',$data);
            }
        }
    }
}
