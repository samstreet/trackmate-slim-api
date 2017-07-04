<?php
/**
 * @author Sam Street <samstreet@evolutionfunding.com>
 */

namespace Trackmate\Core;

use \PDO;

/**
 * Used to wrap PDO because PDO has hard dependencies
 *
 * Class Database
 * @package Trackmate\Core
 */
class Database extends PDO
{
    
    protected $dsn = DB_DSN;
    protected $username = DB_USER;
    protected $password = DB_PASS;
    
    public function __construct()
    {
        parent::__construct($this->dsn, $this->username, $this->password);
    }
}