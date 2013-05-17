<?php
namespace PhpArmory\Exceptions;

/**
 * Extends the Exception class provided by SPL.
 * 
 * @namespace PhpArmory\Exceptions
 * @package PhpArmory
 * @author Nicolai Agersbæk
 * @version 0.1.0
 */
class PhpArmoryException extends \Exception
{
    const PHP_ARMORY_EXCEPTION_NOTICE = 1;
    const PHP_ARMORY_EXCEPTION_WARNING = 2;
    const PHP_ARMORY_EXCEPTION_ERROR = 3;
    
    /**
     * Returns and instance of PhpArmoryException 
     * 
     * @param string $message Error message
     * @param int $code Error code
     * @return PhpArmory\PhpArmoryException
     */
    public function __construct($message, $code = self::PHP_ARMORY_EXCEPTION_NOTICE)
    {
        // Initialize properties from parent
        parent::__construct($message, $code);
    }
}