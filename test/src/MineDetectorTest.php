<?php

/**
 * Class MineDetectorTest.
 */
class StringToArrayTest extends PHPUnit_Framework_TestCase
{

	/**
	 * Test gets a valid array for return.
	 *
	 * @returns void
	 */
	public function testExistClass()
	{
		$stringToArray = new StringToArray();

		$this->assertTrue(is_array($stringToArray->convert()));
	}

	/**
	 * Test validate input with wrong params
	 *
	 * @expectedException InvalidArgumentException
	 */
	public function testValidateInput()
	{
		$stringToArray = new StringToArray();
	}


}
