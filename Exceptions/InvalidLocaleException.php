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
class InvalidLocaleException extends PhpArmoryException
{
    /**
     * Returns an instance of InvalidLocaleException
     * 
     * @param string $region
     * @param string $locale
     * @return PhpArmory\InvalidLocaleException
     */
    public function __construct($region, $locale)
    {
        // Construct from parent
        parent::__construct("Locale '{$locale}' is invalid or not supported in region '{$region}'.", PHP_ARMORY_EXCEPTION_ERROR);
    }
}