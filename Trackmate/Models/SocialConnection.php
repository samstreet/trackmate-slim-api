<?php
/**
 * @author Sam Street
 */

namespace Trackmate\Models;

use Illuminate\Database\Eloquent\Model;

class SocialConnection extends Model
{
    protected $fillable = [
        'id',
        'friend_id',
        'user_id'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    
    /**
     * OneToMany relationship for user and social connection
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('Trackmate\Models\User');
    }
}