<?php
namespace PhpArmory;

use PhpArmory\PhpArmory;

/**
 * Extends the PhpArmory class.
 * 
 * @namespace PhpArmory
 * @package PhpArmory
 * @author Nicolai Agersbæk <nicolai.agersbaek@gmail.com>
 * @version 0.1.0
 * @uses PhpArmory
 */
abstract class RealmList extends PhpArmory
{
    public static function validateRealm($region, $realm, $locale = null) {
        $realmIsValid = false;
        
        // Get instance of PhpArmory for performing query
        $armory = new PhpArmory($region, $locale);
        
        // Realm status query
        $query = 'realm/status';
        
        // Get the result set of a realm status query
        $resultSet = $armory->query($query);
        
        // Does the realm exist in that region
        $realmExistsInRegion = $resultSet->keyValuePairExists('name', $realm);
        
        if ($realmExistsInRegion and !empty($locale)) {
            // A specific locale was specified
            $resultSetAsArray = $resultSet->getAsArray();
            
            foreach($resultSetAsArray['realms'] as $realmData) {
                if ($realmData['name'] == $realm and $realmData['locale'] == $locale) {
                    $realmIsValid = true;
                    break;
                }
            }
        } else if ($realmExistsInRegion and empty($locale)) {
            $realmIsValid = true;
        }
        
        return $realmIsValid;
    }
}