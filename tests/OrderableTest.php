<?php

use C6Digital\Orderable\Tests\Fixtures\Post;
use C6Digital\Orderable\Tests\Fixtures\PostCustomColumn;
use C6Digital\Orderable\Tests\Fixtures\PostCustomReorder;
use C6Digital\Orderable\Tests\Fixtures\PostSetToStart;
use C6Digital\Orderable\Tests\Fixtures\PostWithoutReordering;

afterEach(function () {
    Post::truncate();
    PostCustomColumn::truncate();
    PostSetToStart::truncate();
    PostWithoutReordering::truncate();
});

it('assigns order after create', function () {
    $post = Post::create();

    expect($post->order)->toBe(1);
});

it('will set the order to the end after create', function () {
    Post::create();
    Post::create();

    $post = Post::create();

    expect($post->order)->toBe(3);
});

it('assigns order to custom column after create', function () {
    $post = PostCustomColumn::create();

    expect($post->custom_order)->toBe(1);
});

it('can move order to start and increment existing models', function () {
    $one = PostSetToStart::create();
    $two = PostSetToStart::create();

    expect($two->order)->toBe(1);

    $one->refresh();

    expect($one->order)->toBe(2);
});

it('will not reorder if disabled', function () {
    $one = PostWithoutReordering::create();

    expect($one->order)->toBeNull();
});

it('will use custom set order callback', function () {
    $post = PostCustomReorder::create();

    expect($post->order)->toBe(5000);

    $post = PostCustomReorder::create();

    expect($post->order)->toBe(5000);
});
