<?php

/**
 * Contains the mine detector logic, can reveal the mine adjacent fields.
 */
class StringToArray
{
	/**
	 * Convert the got string value to array.
	 *
	 * @param string $string   The convertable string.
	 *
	 * @return array   The converted array
	 */
	public function convert($string)
	{
		if (gettype($string) != 'string')
		{
			throw new InvalidArgumentException();
		}

		$lines          = explode(PHP_EOL, $string);

		$splittedValues = array();

		foreach ($lines as $line)
		{
			$splittedValue  = explode(',', $line);
			$splittedValues = array_merge($splittedValues, $splittedValue);
		}

		return $splittedValues;
	}
}
