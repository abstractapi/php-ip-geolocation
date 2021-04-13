<?php

namespace Abstractapi\PhoneValidation\Tests;

use PHPUnit\Framework\TestCase;
use Abstractapi\IpGeolocation\AbstractIpGeolocation;
use Abstractapi\IpGeolocation\Common\Exception\InvalidArgumentException;

class AbstractIpGeolocationTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testInvalidAPIKey()
    {
        $this->expectException('Abstractapi\IpGeolocation\Common\Exception\InvalidArgumentException');
        AbstractIpGeolocation::configure('');
    }

      /**
     * @throws \Exception
     */
    public function testInstantiation()
    {
        $API_KEY = getenv('IP_GEO_API_KEY');

        AbstractIpGeolocation::configure($API_KEY);     

        $this->assertSame('https://ipgeolocation.abstractapi.com/v1', AbstractIpGeolocation::getApiEndpoint());

        $this->assertFalse(AbstractIpGeolocation::success());

        $this->assertFalse(AbstractIpGeolocation::getLastError());

        $this->assertSame(array('headers' => null, 'body' => null), AbstractIpGeolocation::getLastResponse());

        $this->assertSame(array(), AbstractIpGeolocation::getLastRequest());
    }

    public function testResponseState()
    {
        $API_KEY = getenv('IP_GEO_API_KEY');

        AbstractIpGeolocation::configure($API_KEY);  
        
        $ip_address = '8.8.8.8';

        $info = AbstractIpGeolocation::look_up($ip_address);
  
        $this->assertTrue(AbstractIpGeolocation::success());  

        $this->assertEquals($ip_address, $info->ip_address);  
    }
 
}