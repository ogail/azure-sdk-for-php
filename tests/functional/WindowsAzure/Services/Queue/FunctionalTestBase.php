<?php

/**
 * Functional tests for the SDK
 *
 * PHP version 5
 *
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
 * @category   Microsoft
 * @package    Tests\Functional\WindowsAzure\Services\Queue
 * @author     Jason Cooke <jcooke@microsoft.com>
 * @copyright  2012 Microsoft Corporation
 * @license    http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link       http://pear.php.net/package/azure-sdk-for-php
 */

namespace Tests\Functional\WindowsAzure\Services\Queue;

use DateTime;
use ReflectionClass;
use ReflectionMethod;
use Tests\Framework\FiddlerFilter;
use Tests\Framework\QueueServiceRestProxyTestBase;
use Tests\Framework\TestResources;
use Tests\Functional\WindowsAzure\Services\Queue\QueueServiceFunctionalTestData;
use WindowsAzure\Core\ServiceException;
use WindowsAzure\Core\WindowsAzureUtilities;
use WindowsAzure\Resources;
use WindowsAzure\Core\Configuration;
use WindowsAzure\Services\Queue\QueueService;
use WindowsAzure\Services\Queue\QueueSettings;

class FunctionalTestBase extends QueueServiceRestProxyTestBase {
    protected $accountName;

    public function __construct()
    {
        parent::__construct();
        $fiddlerFilter = new FiddlerFilter();
        $this->wrapper = $this->wrapper->withFilter($fiddlerFilter);
    }
    
    public function setUp() {
        parent::setUp();
        QueueServiceFunctionalTestData::setupData();
        $this->accountName = $this->config->getProperty(QueueSettings::ACCOUNT_NAME);
        
        foreach(QueueServiceFunctionalTestData::$TEST_QUEUE_NAMES as $name)  {
            $this->safeDeleteQueue($name);
        }

        foreach(QueueServiceFunctionalTestData::$TEST_QUEUE_NAMES as $name)  {
            self::println('Creating queue: ' . $name);
            $this->createQueue($name);
        }
    }

    protected function tearDown()
    {
        parent::tearDown();
        if (!WindowsAzureUtilities::isEmulated()) {
            $serviceProperties = QueueServiceFunctionalTestData::getDefaultServiceProperties();
            $this->wrapper->setServiceProperties($serviceProperties);
        }
        
        foreach(QueueServiceFunctionalTestData::$TEST_QUEUE_NAMES as $name)  {
            $this->safeDeleteQueue($name);
        }
    }
    
    public static function println($msg) {
        error_log($msg);
    }
    
    public static function tmptostring($obj) {
        return 'todo';
    }
}

?>