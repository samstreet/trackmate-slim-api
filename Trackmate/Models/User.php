<?php

namespace Trackmate\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Hashing\BcryptHasher;

/**
 * Class User
 *
 * @package App
 * @author Sam Street
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    
    protected $hasher;
    
    public function __construct(array $attributes = [])
    {
        $this->hasher = new BcryptHasher();
        parent::__construct($attributes);
    }
    
    protected $fillable = [
        'id',
        'name',
        'email',
        'password'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    
    public function locations(){
        return $this->hasMany('Trackmate\Models\Location');
    }
    
    public function verify($email, $password)
    {
        $user = User::where('email', $email)->first();
        if ($user && $this->hasher->check($password, $user->password)) {
            return $user->id;
        }
        return false;
    }
    
}
