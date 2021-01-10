<?php

namespace Cymatica\Hasher\Tests\Feature;

use Cymatica\Hasher\Md5Hasher;
use Cymatica\Hasher\Sha512Hasher;
use Cymatica\Hasher\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HasherTest extends TestCase
{
    /**
     * @test
     */
    public function needsRehashReturnsFalse()
    {
        /**
         * @var Sha512Hasher $hasher
         */
        $hasher = $this->app->make(Sha512Hasher::class);

        $this->assertFalse($hasher->needsRehash('some-hashed-value'));
    }

    /**
     * @test
     */
    public function itMakesTheHash()
    {
        /**
         * @var Sha512Hasher $hasher
         */
        $hasher = $this->app->make(Sha512Hasher::class);

        $password = 'test-password';
        $salt = config('hasher.salt.sha512');
        $hashedPassword = $hasher->make($password);

        $this->assertFalse($password === $hashedPassword);
        $this->assertTrue(password_verify(hash('sha512', $password.$salt), $hashedPassword));
        $this->assertFalse(password_verify(hash('sha256', $password.$salt), $hashedPassword));
    }

    /**
     * @test
     */
    public function itChecksTheHash()
    {
        /**
         * @var Md5Hasher $hasher
         */
        $hasher = $this->app->make(Md5Hasher::class);
        $password = 'test-password';
        $salt = 'test-salt';
        $hashedPassword = $hasher->make($password);
        $hashedPasswordWithDifferentSalt = $hasher->make($password, [
            'salt' => $salt,
        ]);

        $this->assertTrue($hasher->check($password, $hashedPassword));
        $this->assertFalse($hasher->check($password.'--modified', $hashedPassword));

        $this->assertFalse($hasher->check($password, $hashedPasswordWithDifferentSalt));
        $this->assertTrue($hasher->check($password, $hashedPasswordWithDifferentSalt, [
            'salt' => $salt,
        ]));
        $this->assertFalse($hasher->check($password.'--modified-again', $hashedPasswordWithDifferentSalt, [
            'salt' => $salt,
        ]));
    }
}
