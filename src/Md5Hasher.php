<?php

namespace Cymatica\Hasher;

class Md5Hasher extends Hasher
{
    public function algorithm()
    {
        return 'md5';
    }
}
