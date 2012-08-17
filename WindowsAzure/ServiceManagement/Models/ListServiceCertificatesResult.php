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
 * @package   WindowsAzure\ServiceManagement\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
 
namespace WindowsAzure\ServiceManagement\Models;
use WindowsAzure\Common\Internal\Resources;
Use WindowsAzure\Common\Internal\Utilities;

/**
 * The result of calling listServiceCertificates API.
 *
 * @category  Microsoft
 * @package   WindowsAzure\ServiceManagement\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
class ListServiceCertificatesResult
{
    /**
     * @var string
     */
    private $_serviceCertificates;
    
    /**
     * Creates ListServiceCertificatesResult from parsed response into array.
     * 
     * @param array $parsed The parsed HTTP response body.
     * 
     * @return ListServiceCertificatesResult 
     */
    public static function create($parsed)
    {
        $result                       = new ListServiceCertificatesResult();
        $serviceCertificates          = Utilities::createInstanceList(
            Utilities::tryGetArray(Resources::XTAG_CERTIFICATE, $parsed),
            'WindowsAzure\ServiceManagement\Models\ServiceCertificate'
        );
        $result->_serviceCertificates = $serviceCertificates;
        
        return $result;
    }
    
    /**
     * Gets the service certificates.
     * 
     * @return array 
     */
    public function getServiceCertificates()
    {
        return $this->_serviceCertificates;
    }
    
    /**
     * Sets the service certificates.
     * 
     * @param array $serviceCertificates The service certificates.
     * 
     * @return none
     */
    public function setServiceCertificates($serviceCertificates)
    {
        $this->_serviceCertificates = $serviceCertificates;
    }
}