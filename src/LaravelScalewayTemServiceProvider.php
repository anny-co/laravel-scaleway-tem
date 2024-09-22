<?php

namespace Anny\LaravelScalewayTem;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Mailer\Bridge\Scaleway\Transport\ScalewayTransportFactory;
use Symfony\Component\Mailer\Transport\Dsn;


class LaravelScalewayTemServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {

        Mail::extend('scaleway', function (array $config) {
            return (new ScalewayTransportFactory())->create(
                new Dsn('scaleway+api', 'default',
                    $config['project_id'] ?? Config::get('services.scaleway.project_id'),
                    $config['api_key'] ?? Config::get('services.scaleway.api_key'),
                options: ['region' => $config['options']['region'] ?? Config::get('services.scaleway.region')]
                )
            );
        });
    }

}