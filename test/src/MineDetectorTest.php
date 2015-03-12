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
	 *
	 * @dataProvider validateInputProvider
	 */
	public function testValidateInput($convertableParam)
	{
		$this->stringToArrayEntity->convert($convertableParam);
	}

	/**
	 * Provider for input validation with wrong inputs.
	 */
	public function validateInputProvider()
	{
		return array(
			array(
				'null'    => array(''),
				'integer' => 34,
				'array'   => array(1,23,4,5),
				'float'   => 3.234,
				'boolean' => true
			),
		);
	}


}
