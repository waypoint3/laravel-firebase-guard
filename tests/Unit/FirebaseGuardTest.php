<?php

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Auth;
use Lcobucci\JWT\Token\DataSet;
use Lcobucci\JWT\UnencryptedToken;
use Waypoint3\LaravelFirebaseGuard\FirebaseGuard;
use Waypoint3\LaravelFirebaseGuard\User;

beforeEach(function () {
    $this->auth = Mockery::mock(Auth::class);
    $this->request = Mockery::mock(Request::class);
    $this->guard = new FirebaseGuard($this->auth);
});

test('returns null if no bearer token', function () {
    $this->request->shouldReceive('bearerToken')->andReturn(null);
    expect($this->guard->user($this->request))->toBeNull();
});

test('returns null if token not verified', function () {
    $this->request->shouldReceive('bearerToken')->andReturn('token');
    $this->auth->shouldReceive('verifyIdToken')->with('token')->andThrow('Exception');
    expect($this->guard->user($this->request))->toBeNull();
});

test('returns user if token verified', function () {
    $claims = ['sub' => uniqid()];
    $data = new DataSet($claims, 'encodedString');
    $token = Mockery::mock(UnencryptedToken::class);
    $token->shouldReceive('claims')->andReturn($data);
    $this->request->shouldReceive('bearerToken')->andReturn('token');
    $this->auth->shouldReceive('verifyIdToken')->with('token')->andReturn($token);
    expect($this->guard->user($this->request))->toBeInstanceOf(User::class);
});