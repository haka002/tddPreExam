<?php

/**
 * Class MineDetectorTest.
 */
class StringToArrayTest extends PHPUnit_Framework_TestCase
{
	/**
	 * StringToArray entity
	 *
	 * @var StringToArray
	 */
	protected $stringToArrayEntity;

	/**
	 * Runs before every functions.
	 */
	public function setup()
	{
		$this->stringToArrayEntity = new StringToArray();
	}

	/**
	 * Test gets a valid array for return.
	 *
	 * @returns void
	 */
	public function testExistClass()
	{
		$this->assertTrue(is_array($this->stringToArrayEntity->convert()));
	}

	/**
	 * Test validate input with wrong params
	 *
	 * @expectedException InvalidArgumentException
	 */
	public function testValidateInput()
	{

	}


}
