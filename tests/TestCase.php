<?php

namespace C6Digital\Orderable\Tests;

use C6Digital\Orderable\OrderableServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            OrderableServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->timestamps();
        });

        Schema::create('post_without_reorderings', function (Blueprint $table) {
            $table->id();
            $table->integer('order')->nullable();
            $table->timestamps();
        });

        Schema::create('post_set_to_starts', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->timestamps();
        });

        Schema::create('post_custom_reorders', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->timestamps();
        });

        Schema::create('post_custom_columns', function (Blueprint $table) {
            $table->id();
            $table->integer('custom_order');
            $table->timestamps();
        });
    }
}
