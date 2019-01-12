<?php

class HelpersTest extends \PHPUnit\Framework\TestCase {

    function testUid() {
        $uid = uid();

        $this->assertTrue(is_string($uid));
        $this->assertTrue(strlen($uid) == 24);

        $uid = uid(16);

        $this->assertTrue(is_string($uid));
        $this->assertTrue(strlen($uid) == 16);

    }

    function testUint() {
        $uint = uint();
        $uint2 = uint();

        $this->assertTrue(is_int($uint));
        $this->assertTrue($uint != $uint2);
    }

    function testDbdate() {
        $today = dbdate();
        $monthAgo = dbdate('- 1 month');

        $this->assertTrue(is_string($today));
        $this->assertTrue(strtotime($monthAgo) < strtotime($today));
    }

    function testDbtime() {
        $now = dbtime();
        $before = dbtime('- 1 minute');

        $this->assertTrue(is_string($now));
        $this->assertTrue(strtotime($before) < strtotime($now));
    }

    function testAssociate() {
        $objects = [
            (object)[
                'key' => 'a'
            ],
            (object)[
                'key' => 'b'
            ],
        ];
        $expectedObjectsResult = [
            'a' => (object)[
                'key' => 'a'
            ],
            'b' => (object)[
                'key' => 'b'
            ],
        ];
        $arrays = [
            [
                'key' => 'a'
            ],
            [
                'key' => 'b'
            ],
        ];
        $expectedArraysResult = [
            'a' => [
                'key' => 'a'
            ],
            'b' => [
                'key' => 'b'
            ],
        ];

        $objectsTest = associate($objects, 'key');
        $this->assertEquals($expectedObjectsResult, $objectsTest);

        $arraysTest = associate($arrays, 'key');
        $this->assertEquals($expectedArraysResult, $arraysTest);

        $failTest = associate($objects, 'nokey');
        $this->assertEquals([], $failTest);

        $failTest = associate([ 'a string' ], 'nokey');
        $this->assertEquals([], $failTest);
    }

    function testColumn() {
        $objects = [
            (object)[
                'key' => 'a'
            ],
            (object)[
                'key' => 'b'
            ],
        ];

        $arrays = [
            [
                'key' => 'a'
            ],
            [
                'key' => 'b'
            ],
        ];

        $arrays2 = [
            [
                'a', 'b'
            ],
            [
                'b', 'c'
            ],
        ];

        $expectedResult = [ 'a', 'b' ];

        $objectsTest = column($objects, 'key');
        $this->assertEquals($expectedResult, $objectsTest);

        $arraysTest = column($arrays, 'key');
        $this->assertEquals($expectedResult, $arraysTest);

        $arraysTest = column($arrays2, 0);
        $this->assertEquals($expectedResult, $arraysTest);

        $failTest = column($objects, 'nokey');
        $this->assertEquals([], $failTest);

        $failTest = column([ 'a string' ], 'nokey');
        $this->assertEquals([], $failTest);
    }
}