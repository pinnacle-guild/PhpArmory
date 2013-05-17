<?php
namespace PhpArmory;

/**
 * Result set obtained from the Blizzard Community Web API
 * 
 * @namespace PhpArmory
 * @package PhpArmory
 * @author Nicolai Agersbæk <nicolai.agersbaek@gmail.com>
 * @version 0.1.0
 * @todo Implement Traversable/Iterator for easier access
 */
class ResultSet
{
    /**
     * JSON-encoded string containing the raw result set
     * 
     * @var string
     */
    private $json = '';
    
    /**
     * Array containing data from result
     * 
     * @var array
     */
    private $result = array();
    
    /**
     * Returns an instance of ResultSet
     * 
     * @param string $json
     * @return ResultSet
     */
    public function __construct($json)
    {
        // Set JSON
        $this->json = $json;
        
        // Parse JSON into an associative array
        $this->result = json_decode($json, true);
    }
    
    /**
     * Returns the JSON-encoded result string
     * 
     * @return string
     */
    public function getAsJson()
    {
        return $this->json;
    }
    
    /**
     * Returns the entire result set as an associative array
     * 
     * @return
     */
    public function getAsArray()
    {
        return $this->result;
    }
    
    /**
     * Determines if a property in the result set exists
     * 
     * @param string $property
     * @param array $array
     * @return bool
     */
    private function propertyExists($property, $array = null)
    {
        // Fallback for array
        $array = (empty($array)) ? $this->result : $array;
        
        $propertyExists = false;
        
        foreach($array as $k => $v) {
            // Is recursion needed
            if (is_array($v)) {
                $this->propertyExists($property, $v);
            } else {
                if ($v == $property) {
                    $propertyExists = true;
                    break;
                }
            }
        }
        
        return $propertyExists;
    }
    
    /**
     * Determines if a key-value pair in the result set exists
     * 
     * @param string $key
     * @param string $value
     * @param array $array
     * @return bool
     */
    private function keyValuePairExists($key, $value, $array = null)
    {
        // Fallback for array
        $array = (empty($array)) ? $this->result : $array;
        
        $keyValuePairExists = false;
        
        foreach($array as $k => $v) {
            // Is recursion needed
            if (is_array($v)) {
                $this->keyValuePairExists($key, $value, $v);
            } else {
                if ($k == $key and $v == $value) {
                    $propertyExists = true;
                    break;
                }
            }
        }
        
        return $keyValuePairExists; 
    }
}