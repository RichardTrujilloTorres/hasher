<?php

namespace Cymatica\Hasher;

class Sha256Hasher extends Hasher
{
    public function algorithm()
    {
        return 'sha256';
    }
}
