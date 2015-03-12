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
	 * Test the split by commas.
	 *
	 * @dataProvider splitByCommasProvider
	 */
	public function testSplitByCommas($expectedResult, $convertableParam)
	{
		$convertedResult = $this->stringToArrayEntity->convert($convertableParam);

		$this->assertEquals($expectedResult, $convertedResult);
	}

	/**
	 * Provider for input validation with wrong inputs.
	 */
	public function validateInputProvider()
	{
		return array(
			'null'    => array(array('')),
			'integer' => array(34),
			'array'   => array(array(1,23,4,5)),
			'float'   => array(3.234),
			'boolean' => array(true)
		);
	}

	/**
	 * Provider for input splitByCommas.
	 */
	public function splitByCommasProvider()
	{
		return array(
			'one data with empty' => array(array('almafa'), 'almafa'),
			'alone'               => array(array(''), ''),
			'duble empty'         => array(array('',''), ','),
//			'two values'          => array(array('almafa', 'balmafa'), 'almafa,balmafa'),
//			'example1'            => array(array('a','b','c'), 'a,b,c'),
//			'example2'            => array(array('100','982','444','990','1'), '100,982,444,990,1'),
//			'example3'            => array(array('Mark','Anthony','marka@lib.de'), 'Mark,Anthony,marka@lib.de'),
		);
	}


}
