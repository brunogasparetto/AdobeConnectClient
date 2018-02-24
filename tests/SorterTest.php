<?php

use \PHPUnit\Framework\TestCase;
use \AdobeConnectClient\Sorter;

class SorterTest extends TestCase
{
    public function testInstance()
    {
        $this->assertInstanceOf(Sorter::class, Sorter::instance());
    }

    public function testAsc()
    {
        $sorter = Sorter::instance();

        $sorter->asc('dateStart');
        $this->assertEquals(
            ['sort-date-start' => 'asc'],
            $sorter->toArray()
        );

        $sorter->asc('name');
        $this->assertEquals(
            [
                'sort1-date-start' => 'asc',
                'sort2-name' => 'asc'
            ],
            $sorter->toArray()
        );
    }

    public function testDesc()
    {
        $sorter = Sorter::instance();

        $sorter->desc('dateStart');
        $this->assertEquals(
            ['sort-date-start' => 'desc'],
            $sorter->toArray()
        );

        $sorter->desc('name');
        $this->assertEquals(
            [
                'sort1-date-start' => 'desc',
                'sort2-name' => 'desc'
            ],
            $sorter->toArray()
        );
    }

    public function testAscDesc()
    {
        $sorter = Sorter::instance()
            ->asc('dateStart')
            ->desc('name');

        $this->assertEquals(
            [
                'sort1-date-start' => 'asc',
                'sort2-name' => 'desc'
            ],
            $sorter->toArray()
        );

        return $sorter;
    }

    /**
     * @depends testAscDesc
     * @param Sorter $sorter
     */
    public function testRemoveField(Sorter $sorter)
    {
        $sorter->removeField('dateStart');
        $this->assertEquals(['sort-name' => 'desc'], $sorter->toArray());
    }
}