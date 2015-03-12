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
			return $this->createConvertedDo($lines);
		}

		$splittedValues = array();

		foreach ($lines as $line)
		{
			$splittedValue  = $this->parseLine($line);
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
	 * @param array $lines   The converteable lines.
	 *
	 * @return ConvertedValuesDo   The converted values in a do.
	 */
	private function createConvertedDo($lines)
	{
		$labels = $this->parseLine($lines[1]);

		// We have to unset the first and the second lines, because it dont contains any values.
		unset($lines[0]);
		unset($lines[1]);

		$combinedValues = array_combine($labels, $lines);

		$convertedValuesDo = new ConvertedValuesDo();

		$convertedValuesDo->setConvertedData($combinedValues);

		return $convertedValuesDo;
	}
}
