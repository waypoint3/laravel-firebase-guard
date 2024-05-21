<?php

use Waypoint3\LaravelFirebaseGuard\User;

beforeEach(function () {
    $this->claims = [
        'sub' => uniqid()
    ];
    $this->user = new User($this->claims);
});

test('returns claims', function () {
    expect($this->user->toArray())->toBe($this->claims);
});

test('returns attributes', function () {
    expect($this->user->get('sub'))->toBe($this->claims['sub'])
        ->and($this->user->sub)->toBe($this->claims['sub']);
});

test('returns id', function () {
    expect($this->user->id())->toBe($this->claims['sub']);
});

test('authIdentifier returns id', function () {
    expect($this->user->getAuthIdentifier())->toBe($this->claims['sub']);
});
