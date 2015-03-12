<?php

/**
 * Data object for the 3. exercise.
 *
 */
class ConvertedValuesDo {
	/**
	 * The labels of the converted data
	 *
	 * @var array
	 */
	private $labels;

	/**
	 * The values of the converted data
	 *
	 * @var array
	 */
	private $values;

	/**
	 * Gets the array of the converted data.
	 *
	 * @return array
	 */
	public function getConvertedData()
	{
		return array($this->labels, $this->values);
	}

	/**
	 * Set the converted values.
	 *
	 * @param array $labels  The labels of the convered data.
	 * @param array $values  The values of the converted data
	 *
	 * @return void
	 */
	public function setConvertedData(array $labels, array $values)
	{
		$this->labels = $labels;
		$this->values = $values;
	}
}