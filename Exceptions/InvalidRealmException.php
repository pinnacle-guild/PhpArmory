<?php
namespace PhpArmory\Exceptions;

/**
 * Extends the PhpArmoryException class.
 * 
 * @namespace PhpArmory\Exceptions
 * @package PhpArmory
 * @author Nicolai Agersbæk <nicolai.agersbaek@gmail.com>
 * @version 0.1.0
 * @uses PhpArmoryException
 */
class InvalidRealmException extends PhpArmoryException
{
    /**
     * Returns an instance of InvalidRealmException
     * 
     * @param string $region
     * @param string $locale
     * @return PhpArmory\InvalidRealmException
     */
    public function __construct($region, $realm)
    {
        // Construct from parent
        parent::__construct("Realm '{$realm}' does not exist in region '{$region}'.", PHP_ARMORY_EXCEPTION_ERROR);
    }
}