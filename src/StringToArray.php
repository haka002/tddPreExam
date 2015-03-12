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

		$lines = explode(PHP_EOL, $string);

		if ($this->isFirstLineAsLabelled($lines[0]))
		{
			$labels = $this->parseLine($lines[2]);

			return $this->getConvertedDo($labels, $lines);
		}

		$splittedValues = array();

		foreach ($lines as $line)
		{
			$splittedValue = $this->parseLine($line);
			$splittedValues = array_merge($splittedValues, $splittedValue);
		}

		return $splittedValues;
	}

	/**
	 * Says is needs build a new labelled array or not.
	 *
	 * @param string $line   The line of the input.
	 *
	 * @return bool
	 */
	private function isFirstLineAsLabelled($line)
	{
		return $line === '#useFirstLineAsLabels';
	}

	/**
	 * Parses the line by comma.
	 *
	 * @param string $line   The line wich we want to parse.
	 *
	 * @return array   The parsed line by comma.
	 */
	private function parseLine($line)
	{
		return explode(',', $line);
	}

	/**
	 * Gets the do of the values.
	 *
	 * @param array $labels   The labels of the array.
	 * @param array $values   The values of the array.
	 *
	 * @return ConvertedValuesDo   The converted values in a do.
	 */
	private function getConvertedDo($labels, $values)
	{
		// We have to unset the first and the second lines, because it dont contains any values.
		unset($values[0]);
		unset($values[1]);

		$combinedValues = array_combine($labels, $values);

		$convertedValuesDo = new ConvertedValuesDo();

		$convertedValuesDo->setConvertedData($combinedValues);

		return $convertedValuesDo;
	}
}
