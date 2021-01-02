<?php

namespace Cymatica\Hasher;

use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Hashing\AbstractHasher;
use RuntimeException;


abstract class Hasher extends AbstractHasher implements HasherContract
{
    public function make($value, array $options = [])
    {
        $salt = @$options['salt'] ?? config('hasher.salt.'.$this->algorithm());
        $hash = password_hash(hash($this->algorithm(), $value.$salt), PASSWORD_DEFAULT);

        if ($hash === false) {
            throw new RuntimeException($this->algorithm().' hashing not supported.');
        }

        return $hash;
    }

    public function check($value, $hashedValue, array $options = [])
    {
        $salt = @$options['salt'] ?? config('hasher.salt.'.$this->algorithm());
        if (strlen($hashedValue) === 0) {
            return false;
        }

        return password_verify(hash($this->algorithm(), $value.$salt), $hashedValue);
    }

    public function needsRehash($hashedValue, array $options = [])
    {
        return false;
    }

    abstract function algorithm();
}
