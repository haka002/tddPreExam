<?php

/**
 * Class MineDetectorTest.
 */
class MineDetectorTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Mine detector test instance.
	 *
	 * @var MineDetector
	 */
	private $mineDetector;

	public function setUp()
	{
		$this->mineDetector = new MineDetector();
	}

	/**
	 * Test the detect method parameter validation with valid parameter.
	 *
	 * @param array $validMap   Valid test map.
	 *
	 * @dataProvider getValidDetectParameterProvider
	 *
	 * @returns void
	 */
	public function testDetectParameterValidationWorksWithValidParameter(array $validMap)
	{
		$this->mineDetector->detect($validMap);
	}

	/**
	 * Test the detect method parameter validation with invalid parameter.
	 *
	 * @param array $invalidMap   Invalid test map.
	 *
	 * @dataProvider      getInvalidDetectParameterProvider
	 * @expectedException InvalidArgumentException
	 *
	 * @returns void
	 */
	public function testDetectParameterValidationWorksWithInvalidParameter(array $invalidMap)
	{
		$this->mineDetector->detect($invalidMap);
	}

	/**
	 * Test the detect method parameter validation.
	 *
	 * @depends testDetectParameterValidationWorksWithValidParameter
	 * @depends testDetectParameterValidationWorksWithInvalidParameter
	 *
	 * @returns void
	 */
	public function testDetectParameterValidationWorks()
	{

	}

	/**
	 * Test the detect method works.
	 *
	 * @param array $testMap       The test map.
	 * @param array $expectedMap   The expected map, what is already detected.
	 *
	 * @depends      testDetectParameterValidationWorks
	 * @dataProvider getValidDetectParameterProvider
	 *
	 * @return void
	 */
	public function testDetectWorks($testMap, $expectedMap)
	{
		$this->assertEquals($expectedMap, $this->mineDetector->detect($testMap));
	}

	/**
	 * Provides invalid parameters for detect method.
	 *
	 * @return array   The invalid parameters.
	 */
	public function getInvalidDetectParameterProvider()
	{
		return [
			// TODO: I didn't can test with non-array parameter, because the PHP unit throw error before test run.
			// TODO: Without non_array I can't reach the full coverage, so I ignored the code coverage for
			// TODO: array check in the code.
			//'non_array'   => [null],
			'non_matrix_non_array_row' => [
				[null]
			],
			'non_matrix_different_row_length' => [
				[
					[null, null],
					[null],
				],
			],
			'matrix_contains_invalid_field' => [
				[
					[null, 0],
					[null, null],
				],
			]
		];
	}

	/**
	 * Provides valid parameters for detect method.
	 *
	 * @return array   The valid parameters.
	 */
	public function getValidDetectParameterProvider()
	{
		return [
			'1x1_no_mine' => [
				[
					[null]
				],
				[
					[0]
				]
			],
			'1x1_one_mine' => [
				[
					['*']
				],
				[
					['*']
				]
			],
			'1x2_one_mine' => [
				[
					['*', null]
				],
				[
					['*', 1]
				]
			],
			'1x3_one_mine' => [
				[
					[null, '*', null]
				],
				[
					[1, '*', 1]
				]
			],
			'1x3_two_mines' => [
				[
					['*', null, '*']
				],
				[
					['*', 2, '*']
				]
			],
			'2x3_two_mines' => [
				[
					['*', null, null],
					[null, '*', null],
				],
				[
					['*', 2, 1],
					[2, '*', 1],
				]
			],
			'3x3_eight_mines' => [
				[
					['*', '*', '*'],
					['*', null, '*'],
					['*', '*', '*'],
				],
				[
					['*', '*', '*'],
					['*', 8, '*'],
					['*', '*', '*'],
				]
			],
			'3x4_two_mines' => [
				[
					['*', null, null, null],
					[null, null, '*', null],
					[null, null, null, null],
				],
				[
					['*', 2, 1, 1],
					[1, 2, '*', 1],
					[0, 1, 1, 1],
				]
			],
		];
	}
}
