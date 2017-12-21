<?php

namespace JPush\Tests;

class SchedulePayloadTest extends \PHPUnit_Framework_TestCase
{

    public function testGetSchedules()
    {
        $schedule = $this->schedule;
        $response = $schedule->getSchedules();
        $this->assertEquals('200', $response['http_code']);
    }

    protected function setUp()
    {
        global $client;
        $this->schedule = $client->schedule();
    }

}
