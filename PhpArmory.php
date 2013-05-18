<?php
namespace PhpArmory;

use PhpArmory\RealmList;
use PhpArmory\Exceptions\PhpArmoryException;
use PhpArmory\Exceptions\InvalidQueryException;
use PhpArmory\Exceptions\InvalidRegionException;
use PhpArmory\Exceptions\InvalidLocaleException;

/**
 * PhpArmory abstracts the use of the Blizzard Community Platform API.
 * 
 * By providing an object-oriented approach to communicating with the
 * Blizzard Community Platform API, this class simplifies queries
 * made against the RESTful API of Blizzard.
 * 
 * @namespace PhpArmory
 * @package PhpArmory
 * @author Nicolai Agersbæk <nicolai.agersbaek@gmail.com>
 * @version 0.1.0
 * @uses PhpArmory\RealmList
 * @uses PhpArmory\Exceptions\PhpArmoryException
 * @uses PhpArmory\Exceptions\InvalidQueryException
 * @uses PhpArmory\Exceptions\InvalidRegionException
 * @uses PhpArmory\Exceptions\InvalidLocaleException
 */
class PhpArmory
{
    /**
     * Map of full name, host name and supported locales for each supported region
     * 
     * @var array
     */
    private $regionHostList = array(
        'us' => array(
            'name' => 'US',
            'host' => 'us.battle.net',
            'locales' => array(
                'en_US',
                'es_MX',
                'pt_BR',
            ),
        ),
        'eu' => array(
            'name' => 'Europe',
            'host' => 'eu.battle.net',
            'locales' => array(
                'en_GB',
                'es_ES',
                'fr_FR',
                'ru_RU',
                'de_DE',
                'pt_PT',
                'it_IT',
            ),
        ),
        'kr' => array(
            'name' => 'Korea',
            'host' => 'kr.battle.net',
            'locales' => array(
                'kr_KR'
            ),
        ),
        'tw' => array(
            'name' => 'Taiwan',
            'host' => 'tw.battle.net',
            'locales' => array(
                'zh_TW'
            ),
        ),
        'cn' => array(
            'name' => 'China',
            'host' => 'www.battle.net.com.cn',
            'locales' => array(
                'zh_CN'
            ),
        ),
    );
    
    /**
     * Base URL against which we perform queries
     * 
     * @var string
     */
    private $baseURL = 'http://';

    /**
     * Returns an instance of PhpArmory
     * 
     * @param string $region
     * @param string $locale
     * @return PhpArmory
     */
    public function __construct($region, $locale = null)
    {
        // Validate region
        $this->validateRegion($region);
        
        // Craft baseURL
        $this->baseURL .= $this->regionHostList[$region]['host'] . '/api/wow/';
        
        // Set locale, if provided
        if (!empty($locale)) {
            $this->validateLocale($this->region, $locale);
        }
    }
    
    /**
     * Validates a region name against supported regions
     * 
     * @param string $region
     * @return void
     * @throws InvalidRegionException
     */
    private function validateRegion($region)
    {
        // Is region supported
        if (empty($this->regionHostList[$region])) {
            throw new InvalidRegionException($region);
        } else {
            $this->region = $region;
        }
    }
    
    /**
     * Validates a locale name against supported locales
     * 
     * @param string $region
     * @param string $locale
     * @return void
     * @throws InvalidLocaleException
     */
    private function validateLocale($region, $locale = null)
    {
        // Default to supported locale
        if (empty($locale)) {
            $locale = $this->regionHostList[$region]['locales'][0];
            $this->locale = $locale;
        } else {
            // Is locale supported in region
            if (!in_array($locale, $this->regionHostList[$region]['locales'][$locale])) {
                throw new InvalidLocaleException($region, $locale);
            } else {
                $this->locale = $locale;    
            }    
        } 
    }
    
    
    /**
     * Perform a query against the REST service
     * 
     * @param string $query URL string denoting the query
     * @return ResultSet
     * @throws InvalidQueryException
     */
    private function query($query, $region = null)
    {
        // Set region fallback
        $region = (empty($region)) ? $this->region : $region;
         
        // Perform query
        $queryRawReturn = file_get_contents($this->baseURL . $query);
        
        if ($queryRawReturn === false) {
            throw InvalidQueryException("Unable to get query result for category '{$category}'.");
        } else {
            return new ResultSet($queryRawReturn);    
        }      
    }
    
    /**
     * Sets the realm for the PhpArmory to query against
     * 
     * @param string $realm
     * @return void
     * @throws PhpArmoryException
     */
    public function setRealm($realm)
    {
        // Is locale set
        if (empty($this->locale)) {
            // Validate realm name (with no locale specified)
            $realmIsValid = RealmList::validateRealm($this->region, $realm);    
        } else {
            $realmIsValid = RealmList::validateRealm($this->region, $realm, $locale);
        }
        
        if ($realmIsValid) {
            $this->realm = $realm;
        } else {
            throw new PhpArmoryException("Attempt to set to invalid realm '{$realm}'" . (empty($this->locale) ? "." : " under locale '{$this->locale}'."));
        }
    }
}