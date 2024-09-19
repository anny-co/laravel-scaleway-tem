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
        $mailers = Config::get('mail.mailers');
        $mailers['scaleway'] = [
            'transport' => 'scaleway',
        ];
        Config::set(['mail.mailers' => $mailers]);

        Mail::extend('scaleway', function () {
            return (new ScalewayTransportFactory())->create(
                new Dsn('scaleway+api', 'default',
                    Config::get('services.scaleway.project_id'),
                    Config::get('services.scaleway.api_key'),
                options: ['region' => Config::get('services.scaleway.region')]
                )
            );
        });
    }

}