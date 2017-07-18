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
        
        $user = $this->getUserId();
        
        try {
            $location = Location::create([
                'lat' => $request->get('lat'),
                'lon' => $request->get('lon'),
                'user_id' => $user
            ]);
            die(var_dump($location));
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 400);
        }
    
        return $this->success([
            'success' => true,
            'message' => 'User Location Saved'
        ], 201);
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