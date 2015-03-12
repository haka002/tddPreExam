<?php

/**
 * Data object for the 3. exercise.
 *
 */
class ConvertedValuesDo {
	/**
	 * An array for passing the converted data.
	 *
	 * @var array
	 */
	private $convertedData;

	/**
	 * Gets the array of the converted data.
	 *
	 * @return array
	 */
	public function getConvertedData()
	{
		return $this->convertedData;
	}

	/**
	 * Set the converted values.
	 *
	 * @param array $convertedData  The converted data.
	 */
	public function setConvertedData(array $convertedData)
	{
		$this->convertedData = $convertedData;
	}
}