<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Crypt;

class DecryptService
{
    public function encryptId(String $id): String
    {
        return Crypt::encryptString($id);
    }

    public function decryptId(String $id): String
    {
        return Crypt::decryptString($id);
    }

}
