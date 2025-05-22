<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ConfCorreo;
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
        $config = ConfCorreo::first();

        if ($config) {
            config([
                'mail.mailers.smtp.host' => $config->host,
                'mail.mailers.smtp.port' => $config->port,
                'mail.mailers.smtp.encryption' => $config->encryption ?: null,
                'mail.mailers.smtp.username' => $config->username,
                'mail.mailers.smtp.password' => $config->password,
                'mail.from.address' => $config->from_address,
                'mail.from.name' => $config->from_name,
            ]);
        }
    }
}
