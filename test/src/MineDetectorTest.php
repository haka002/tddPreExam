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
	public function tesExistClass()
	{
		$stringToArray = new StringToArray();

		$this->assertTrue(is_array($stringToArray->convertStringToArray()));
	}


}
