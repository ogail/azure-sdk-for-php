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

/**
 * The interface for HTTP Web requests.
 *
 * @category  Microsoft
 * @package   WindowsAzure\Common\Internal\Http
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
interface IRequest
{
    /**
     * Gets method.
     * 
     * @return string
     */
    public function getMethod();
    
    /**
     * Sets method.
     * 
     * @param string $method The method value.
     * 
     * @return none
     */
    public function setMethod($method);
    
    /**
     * Gets headers.
     * 
     * @return array
     */
    public function getHeaders();
    
    /**
     * Sets headers.
     * 
     * Ignores the header if its value is empty.
     * 
     * @param array $headers The headers value.
     * 
     * @return none
     */
    public function setHeaders($headers);
    
    /**
     * Gets uri.
     * 
     * @return IUrl
     */
    public function getUri();
    
    /**
     * Sets uri.
     * 
     * @param string $uri The uri value.
     * 
     * @return none
     */
    public function setUri($uri);
    
    /**
     * Gets body.
     * 
     * @return string
     */
    public function getBody();
    
    /**
     * Sets body.
     * 
     * @param string|resource $body The body valye. Either a string with the body or
     * pointer to an open file.
     * 
     * @return none
     */
    public function setBody($body);

    /** 
     * Sets HTTP POST parameters.
     * 
     * @param array $postParameters The HTTP POST parameters.
     * 
     * @return none
     */
    public function setPostParameters($postParameters);
    
    /**
     * Adds or sets header pair.
     * 
     * @param string $name  The HTTP header name.
     * @param mix    $value The HTTP header value.
     * 
     * @return none
     */
    public function setHeader($name, $value);
    
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
    public function setOptionalHeader($name, $value);
    
    /**
     * Gets header value.
     * 
     * @param string $name The header name.
     * 
     * @return mix
     */
    public function getHeader($name);
    
    /**
     * Adds or sets HTTP POST parameter pair.
     * 
     * @param string $key   The HTTP POST parameter name.
     * @param mix    $value The HTTP POST parameter value.
     * 
     * @return none
     */
    public function addPostParameter($key, $value);
    
    /**
     * Sends the HTTP request to the wire and receives the response.
     * 
     * @return IResponse
     */
    public function send();
    
    /**
     * Converts the request object into HTTP request string.
     * 
     * @return string 
     */
    public function __toString();
}