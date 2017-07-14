<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Hashing\BcryptHasher;

class Controller extends BaseController
{
    protected $hasher;
    
    public function __construct(BcryptHasher $hasher)
    {
        $this->hasher = $hasher;
    }
    
    public function success($data, $code){
        return response()->json(['data' => $data], $code);
    }
    public function error($message, $code){
        return response()->json(['message' => $message], $code);
    }
}
