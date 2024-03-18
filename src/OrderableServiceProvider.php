<?php

namespace C6Digital\Orderable;

use C6Digital\Orderable\Commands\OrderableCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class OrderableServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-orderable');
    }
}
