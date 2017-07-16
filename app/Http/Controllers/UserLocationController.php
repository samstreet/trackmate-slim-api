<?php
/**
 * @author Sam Street
 */

namespace App\Http\Controllers;


use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;

class UserLocationController extends Controller
{
    
    public function __construct(BcryptHasher $hasher)
    {
        $this->middleware('oauth');
        
        parent::__construct($hasher);
    }
    
    public function store(Request $request)
    {
        return [];
    }
    
    public function get($id)
    {
        return [];
    }
    
    public function all()
    {
        return[];
    }
}