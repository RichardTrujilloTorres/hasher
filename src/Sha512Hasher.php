<?php

namespace Cymatica\Hasher;

class Sha512Hasher extends Hasher
{
    public function algorithm()
    {
        return 'sha512';
    }
}
