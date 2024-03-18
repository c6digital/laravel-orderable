<?php

namespace C6Digital\Orderable;

use C6Digital\Orderable\Commands\OrderableCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class OrderableServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-orderable')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-orderable_table')
            ->hasCommand(OrderableCommand::class);
    }
}
