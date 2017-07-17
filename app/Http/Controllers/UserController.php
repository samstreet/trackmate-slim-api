<?php
/**
 * @author Sam Street
 */

namespace App\Http\Controllers;

use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Trackmate\Models\User;

class UserController extends Controller
{
    
    public function __construct(BcryptHasher $hasher)
    {
        $this->middleware('oauth', ['except' => ['index', 'show']]);
        
        parent::__construct($hasher);
    }
    
    public function index()
    {
        $users = User::all();
        return response()->json(['data' => $users], 200);
    }
    
    public function store(Request $request)
    {
        $this->validateRequest($request);
        
        $hash = $this->hasher->make($request->get('password'));
        
        $user = User::create([
            'email' => $request->get('email'),
            'password' => $hash
        ]);
        
        return response()->json(['data' => "The user with with id {$user->id} has been created"], 201);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => "The user with {$id} doesn't exist"], 404);
        }
        return response()->json(['data' => $user], 200);
    }
    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => "The user with {$id} doesn't exist"], 404);
        }
        $this->validateRequest($request);
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();
        return response()->json(['data' => "The user with with id {$user->id} has been updated"], 200);
    }
    
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => "The user with {$id} doesn't exist"], 404);
        }
        $user->delete();
        return response()->json(['data' => "The user with with id {$id} has been deleted"], 200);
    }
    
    public function validateRequest(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ];
        $this->validate($request, $rules);
    }
}