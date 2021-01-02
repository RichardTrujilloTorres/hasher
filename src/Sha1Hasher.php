<?php

namespace Cymatica\Hasher;

class Sha1Hasher extends Hasher
{
    public function algorithm()
    {
        return 'sha1';
    }
}
