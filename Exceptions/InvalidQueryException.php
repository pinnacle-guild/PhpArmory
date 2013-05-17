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
class InvalidQueryException extends PhpArmoryException
{
    /**
     * Returns an instance of InvalidQueryException
     * 
     * @param string $region
     * @return PhpArmory\InvalidQueryException
     */
    public function __construct($message)
    {
        // Construct from parent
        parent::__construct($message, PHP_ARMORY_EXCEPTION_ERROR);
    }
}