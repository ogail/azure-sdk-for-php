<?php

/**
 * LICENSE: Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * PHP version 5
 *
 * @category  Microsoft
 * @package   WindowsAzure\ServiceManagement\Internal
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
 
namespace WindowsAzure\ServiceManagement\Internal;
use WindowsAzure\Common\Internal\Utilities;
use WindowsAzure\Common\Internal\Validate;
use WindowsAzure\Common\Internal\Resources;
use WindowsAzure\ServiceManagement\Models\ServiceProperties;

/**
 * General service properties.
 *
 * @category  Microsoft
 * @package   WindowsAzure\ServiceManagement\Internal
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
class ServicePropertiesResult
{
    /**
     * @var array
     */
    protected $services;
    
    /**
     * @var array 
     */
    protected $entries;
    
    /**
     * Creates new ServicePropertiesResult from parsed response body.
     * 
     * @param array  $parsed The parsed response body.
     * @param string $tag    The service properties root tag name.
     */
    public function __construct($parsed, $tag)
    {
        Validate::notNullOrEmpty($tag, 'tag');
        Validate::isString($tag, 'tag');
        
        $this->services = array();
        $this->entries  = Utilities::tryGetArray($tag, $parsed);
        
        foreach ($this->entries as $value) {
            $properties = new ServiceProperties();
            $properties->setServiceName(
                Utilities::tryGetValue($value, Resources::XTAG_SERVICE_NAME)
            );
            $properties->setUrl(
                Utilities::tryGetValue($value, Resources::XTAG_URL)
            );
            $this->services[] = $properties;
        }
    }
}