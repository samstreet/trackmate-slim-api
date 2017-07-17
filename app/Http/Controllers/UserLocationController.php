<?php
/**
 * @author Sam Street
 */

namespace App\Http\Controllers;


use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Trackmate\Models\Location;
use Trackmate\Models\User;

class UserLocationController extends Controller
{
    
    public function __construct(BcryptHasher $hasher)
    {
        $this->middleware('oauth');
        
        parent::__construct($hasher);
    }
    
    public function store(Request $request)
    {
        //$this->validateRequest($request);
        
        $user = User::find($request->get("user_id"));
        
        $location = Location::create(
            'lat'
        );
        
        return response()->json(['data' => "The user with with id {$user->id} has been created"], 201);
    }
    
    public function get($user_id, $location_id)
    {
        return [];
    }
    
    public function all()
    {
        return [];
    }
    
    private function validateRequest(Request $request)
    {
        $rules = [
            'lat' => 'required',
            'lon' => 'required',
        ];
        
        $this->validate($request, $rules);
    }
}