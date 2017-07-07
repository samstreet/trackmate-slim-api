<?php
/**
 * @author Sam Street
 */

namespace Trackmate\Service\User;


use Trackmate\Models\User;

class UserAccountService
{
    /**
     * Create a new user
     *
     * @param array $data the user data
     *
     * @return User
     */
    public function create($data)
    {
        return new User();
    }
    
    /**
     * Delete a user
     *
     * @param User $user
     *
     * @return bool
     */
    public function delete(User $user)
    {
        return true;
    }
}