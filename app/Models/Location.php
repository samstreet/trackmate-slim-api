<?php
/**
 * @author Sam Street
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 *
 * @package Trackmate\Models
 *
 * @author Sam Street <samstreet.dev@gmail.com>
 */
class Location extends Model
{
    protected $fillable = [
        'id',
        'lat',
        'lon',
        'user_id'
    ];
    
    protected $hidden = [
        'created_at'
    ];
    
    /**
     * One To Many
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo('Trackmate\Models\User');
    }
}