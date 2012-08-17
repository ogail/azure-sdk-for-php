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
use WindowsAzure\Common\Internal\Utilities;

/**
 * The hosted service certificate.
 *
 * @category  Microsoft
 * @package   WindowsAzure\ServiceManagement\Models
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
class ServiceCertificate
{
    /**
     * @var string
     */
    private $_certificateUrl;
    
    /**
     * @var string
     */
    private $_thumbprint;
    
    /**
     * @var string
     */
    private $_thumbprintAlgorithm;
    
    /**
     * @var string
     */
    private $_data;
    
    /**
     * Creates ServiceCertificate from parsed response into array.
     * 
     * @param array $parsed The parsed HTTP response body.
     * 
     * @return ServiceCertificate 
     */
    public static function create($parsed)
    {
        $result              = new ServiceCertificate();
        $certificateUrl      = Utilities::tryGetValue(
            $parsed,
            Resources::XTAG_CERTIFICATE_URL
        );
        $thumbprint          = Utilities::tryGetValue(
            $parsed,
            Resources::XTAG_THUMBPRINT
        );
        $thumbprintAlgorithm = Utilities::tryGetValue(
            $parsed,
            Resources::XTAG_THUMBPRINT_ALGORITHM
        );
        $data                = Utilities::tryGetValue(
            $parsed,
            Resources::XTAG_DATA
        );
        
        $result->setCertificateUrl($certificateUrl);
        $result->setData($data);
        $result->setThumbprint($thumbprint);
        $result->setThumbprintAlgorithm($thumbprintAlgorithm);
        
        return $result;
    }
    
    /**
     * Gets the service certificate URL.
     * 
     * The Service Management API request URI used to perform getServiceCertificate 
     * requests against the certificate store.
     * 
     * @return string
     */
    public function getCertificateUrl()
    {
        return $this->_certificateUrl;
    }
    
    /**
     * Sets the service certificate URL.
     * 
     * @param string $certificateUrl The service certificate URL.
     * 
     * @return none
     */
    public function setCertificateUrl($certificateUrl)
    {
        $this->_certificateUrl = $certificateUrl;
    }
    
    /**
     * Gets the service certificate thumbprint.
     * 
     * The X509 certificate thumb print property of the service certificate.
     * 
     * @return string
     */
    public function getThumbprint()
    {
        return $this->_thumbprint;
    }
    
    /**
     * Sets the service certificate thumbprint.
     * 
     * @param string $thumbprint The service certificate thumbprint.
     * 
     * @return none
     */
    public function setThumbprint($thumbprint)
    {
        $this->_thumbprint = $thumbprint;
    }
    
    /**
     * Gets the service certificate thumbprint algorithm.
     * 
     * The algorithm that was used to hash the service certificate. Currently SHA-1 
     * is the only supported algorithm.
     * 
     * @return string
     */
    public function getThumbprintAlgorithm()
    {
        return $this->_thumbprintAlgorithm;
    }
    
    /**
     * Sets the service certificate thumbprint algorithm.
     * 
     * @param string $thumbprintAlgorithm The service certificate thumbprint 
     * algorithm.
     * 
     * @return none
     */
    public function setThumbprintAlgorithm($thumbprintAlgorithm)
    {
        $this->_thumbprintAlgorithm = $thumbprintAlgorithm;
    }
    
    /**
     * Gets the service certificate data.
     * 
     * The public part of the service certificate as a base-64 encoded .cer file.
     * 
     * @return string
     */
    public function getData()
    {
        return $this->_data;
    }
    
    /**
     * Sets the service certificate data.
     * 
     * @param string $data The service certificate data.
     * 
     * @return none
     */
    public function setData($data)
    {
        $this->_data = $data;
    }
}