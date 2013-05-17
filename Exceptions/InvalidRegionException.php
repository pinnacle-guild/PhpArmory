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
class InvalidRegionException extends PhpArmoryException
{
    /**
     * Returns an instance of InvalidRegionException
     * 
     * @param string $region
     * @return PhpArmory\InvalidRegionException
     */
    public function __construct($region)
    {
        // Construct from parent
        parent::__construct("Region '{$region}' is invalid or not supported.", PHP_ARMORY_EXCEPTION_ERROR);
    }
}