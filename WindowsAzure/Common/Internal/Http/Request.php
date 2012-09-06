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
 * @package   WindowsAzure\Common\Internal\Http
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
 
namespace WindowsAzure\Common\Internal\Http;
use WindowsAzure\Common\Internal\Resources;
use WindowsAzure\Common\Internal\Utilities;
use WindowsAzure\Common\Internal\Http\Url;

require_once 'HTTP/Request2.php';

/**
 * The default HTTP Web request class.
 *
 * @category  Microsoft
 * @package   WindowsAzure\Common\Internal\Http
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
class Request implements IRequest
{
    /**
     * @var \HTTP_Request2
     */
    private $_request;
    
    /**
     * Initializes new HttpClient object.
     * 
     * @param string $certificatePath          The certificate path.
     * @param string $certificateAuthorityPath The path of the certificate authority.
     * 
     * @return WindowsAzure\Common\Internal\Http\Request
     */
    function __construct(
        $certificatePath = Resources::EMPTY_STRING,
        $certificateAuthorityPath = Resources::EMPTY_STRING
    ) {
        $config = array(
            Resources::USE_BRACKETS    => true,
            Resources::SSL_VERIFY_PEER => false,
            Resources::SSL_VERIFY_HOST => false
        );

        if (!empty($certificatePath)) {
            $config[Resources::SSL_LOCAL_CERT]  = $certificatePath;
            $config[Resources::SSL_VERIFY_HOST] = true;
        }

        if (!empty($certificateAuthorityPath)) {
            $config[Resources::SSL_CAFILE]      = $certificateAuthorityPath;
            $config[Resources::SSL_VERIFY_PEER] = true;
        }

        $this->_request             = new \HTTP_Request2(null, null, $config);
        $this->_expectedStatusCodes = array();
    }
    
    /**
     * Gets method.
     * 
     * @return string
     */
    public function getMethod()
    {
        return $this->_request->getMethod();
    }
    
    /**
     * Sets method.
     * 
     * @param string $method The method value.
     * 
     * @return none
     */
    public function setMethod($method)
    {
        $this->_request->setMethod($method);
    }
    
    /**
     * Gets headers.
     * 
     * @return array
     */
    public function getHeaders()
    {
        return $this->_request->getHeaders();
    }
    
    /**
     * Sets headers.
     * 
     * Ignores the header if its value is empty.
     * 
     * @param array $headers The headers value.
     * 
     * @return none
     */
    public function setHeaders($headers)
    {
        $this->_request->setHeader($headers);
    }
    
    /**
     * Gets uri.
     * 
     * @return IUrl
     */
    public function getUri()
    {
        return new Url($this->_request->getUrl());
    }
    
    /**
     * Sets uri.
     * 
     * @param string string The uri value.
     * 
     * @return none
     */
    public function setUri($uri)
    {
        $this->_request->setUrl($uri);
    }
    
    /**
     * Gets body.
     * 
     * @return string
     */
    public function getBody()
    {
        return $this->_request->getBody();
    }
    
    /**
     * Sets body.
     * 
     * @param string|resource $body The body valye. Either a string with the body or
     * pointer to an open file.
     * 
     * @return none
     */
    public function setBody($body)
    {
        $this->_request->setBody($body);
    }
    
    /**
     * Adds or sets header pair.
     * 
     * @param string $name  The HTTP header name.
     * @param mix    $value The HTTP header value.
     * 
     * @return none
     */
    public function setHeader($name, $value)
    {
        $this->_request->setHeader($name, $value);
    }
    
    /**
     * Adds or sets header pair.
     * 
     * Ignores header if it's value satisfies empty().
     * 
     * @param string $name  The HTTP header name.
     * @param mix    $value The HTTP header value.
     * 
     * @return none
     */
    public function setOptionalHeader($name, $value)
    {
        if (!empty($value)) {
            $this->setHeader($name, $value);
        }
    }

    /** 
     * Sets HTTP POST parameters.
     * 
     * @param array $postParameters The HTTP POST parameters.
     * 
     * @return none
     */
    public function setPostParameters($postParameters)
    {
        $this->_request->addPostParameter($postParameters);
    }
    
    /**
     * Gets header value.
     * 
     * @param string $name The header name.
     * 
     * @return mix
     */
    public function getHeader($name)
    {
        $headers = $this->_request->getHeaders();
        return Utilities::tryGetValue($headers, $name);
    }
    
    /**
     * Converts the request object into HTTP request string.
     * 
     * @return string 
     */
    public function __toString()
    {
        $rowHeaders = $this->getHeaders();
        $headers    = Resources::EMPTY_STRING;
        $uri        = $this->getUri()->__toString();
        
        foreach ($rowHeaders as $key => $value) {
            $headers .= "$key: $value\n";
        }
        
        $string = "$this->getMethod() $uri HTTP/1.1\n$headers\n$this->_body";
        
        return $string;
    }
}