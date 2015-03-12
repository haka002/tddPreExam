<?php

/**
 * Contains the mine detector logic, can reveal the mine adjacent fields.
 */
class MineDetector
{
	/** The mine field. */
	const FIELD_MINE = '*';

	/** The empty field. */
	const FIELD_EMPTY = null;

	/**
	 * The valid fields.
	 *
	 * @var array
	 */
	private static $validFields = [
		self::FIELD_MINE,
		self::FIELD_EMPTY
	];

	/**
	 * The neighbour index modifiers.
	 *
	 * @var array
	 */
	private static $neighbourIndexModifiers = [
		[-1, -1],
		[-1, 0],
		[-1, 1],
		[0, -1],
		[0, 1],
		[1, -1],
		[1, 0],
		[1, 1],
	];

	/**
	 * Detect the mines on a map. Calculate how many mines are exists in the neighbours for each non-mined fields.
	 *
	 * @param array $map   The mined map.
	 *
	 * @throws InvalidArgumentException   On invalid argument.
	 *
	 * @return array   The detected map.
	 */
	public function detect(array $map)
	{
		if (!$this->isValidMap($map))
		{
			throw new InvalidArgumentException;
		}

		$map = $this->setEmptyFieldsToZero($map);
		$map = $this->setMineFieldNeighbours($map);

		return $map;
	}

	/**
	 * Set the mine fields to adjacent mines number.
	 *
	 * @param array $map   The map.
	 *
	 * @return array   The map.
	 */
	private function setMineFieldNeighbours(array $map)
	{
		foreach ($map as $rowIndex => $row)
		{
			foreach ($row as $columnIndex => $field)
			{
				if (!$this->isMine($field))
				{
					continue;
				}

				$neighbourIndexList = $this->getFieldNonMineNeighbours($rowIndex, $columnIndex, $map);
				$map                = $this->increaseFieldNumbers($neighbourIndexList, $map);
			}
		}

		return $map;
	}

	/**
	 * Gets the field's non mine neighbour index list.
	 *
	 * @param int   $rowIndex      Row index.
	 * @param int   $columnIndex   Column index.
	 * @param array $map           The map.
	 *
	 * @return array   The field's non mine neighbour index list.
	 */
	private function getFieldNonMineNeighbours($rowIndex, $columnIndex, array $map)
	{
		$neighbourIndexList = [];

		foreach (self::$neighbourIndexModifiers as $indexModifier)
		{
			$neighbourRowIndex    = $rowIndex + $indexModifier[0];
			$neighbourColumnIndex = $columnIndex + $indexModifier[1];

			if (isset($map[$neighbourRowIndex][$neighbourColumnIndex]))
			{
				if (!$this->isMine($map[$neighbourRowIndex][$neighbourColumnIndex]))
				{
					$neighbourIndexList[] = [$neighbourRowIndex, $neighbourColumnIndex];
				}
			}
		}

		return $neighbourIndexList;
	}

	/**
	 * Increase the field numbers.
	 *
	 * @param array $indexList   The field index list.
	 * @param array $map         The map.
	 *
	 * @return array   The map with the increased field.
	 */
	private function increaseFieldNumbers(array $indexList, array $map)
	{
		foreach ($indexList as $index)
		{
			$map = $this->increaseFieldNumber($index[0], $index[1], $map);
		}

		return $map;
	}

	/**
	 * Increase the field number.
	 *
	 * @param int   $rowIndex      Row index.
	 * @param int   $columnIndex   Column index.
	 * @param array $map           The map.
	 *
	 * @return array   The map with the increased field.
	 */
	private function increaseFieldNumber($rowIndex, $columnIndex, array $map)
	{
		$map[$rowIndex][$columnIndex]++;

		return $map;
	}

	/**
	 * Set the empty fields to zero.
	 *
	 * @param array $map   The map.
	 *
	 * @return array   The map.
	 */
	private function setEmptyFieldsToZero(array $map)
	{
		foreach ($map as $rowIndex => $row)
		{
			foreach ($row as $columnIndex => $field)
			{
				if (!$this->isMine($field))
				{
					$map[$rowIndex][$columnIndex] = 0;
				}
			}
		}

		return $map;
	}

	/**
	 * Gets is mine field.
	 *
	 * @param mixed $field   The field
	 *
	 * @return bool   True, if the field is mine.
	 */
	private function isMine($field)
	{
		return self::FIELD_MINE === $field;
	}

	/**
	 * Check is a valid map.
	 *
	 * @param array $map   The map.
	 *
	 * @return bool   True on valid map.
	 */
	private function isValidMap(array $map)
	{
		if (!$this->isMatrix($map))
		{
			return false;
		}

		if ($this->hasInvalidFieldOnMap($map))
		{
			return false;
		}

		return true;
	}

	/**
	 * Check has invalid field on map.
	 *
	 * @param array $map The map.
	 *
	 * @return bool   True if has invalid field on map.
	 */
	private function hasInvalidFieldOnMap(array $map)
	{
		foreach ($map as $row)
		{
			foreach ($row as $field)
			{
				if (!$this->isValidField($field))
				{
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Check is valid field.
	 *
	 * @param mixed $field   The field.
	 *
	 * @return bool   True on valid field.
	 */
	private function isValidField($field)
	{
		return in_array($field, self::$validFields, true);
	}

	/**
	 * Check is a matrix.
	 *
	 * @param array $matrix   The matrix.
	 *
	 * @return bool   True on valid matrix.
	 */
	private function isMatrix(array $matrix)
	{
		// @codeCoverageIgnoreStart
		if (!is_array($matrix))
		{
			return false;
		}
		// @codeCoverageIgnoreEnd

		$columnNumber = null;

		foreach ($matrix as $row)
		{
			if (!is_array($row))
			{
				return false;
			}

			if (!isset($columnNumber))
			{
				$columnNumber = count($row);
			}
			elseif (count($row) !== $columnNumber)
			{
				return false;
			}
		}

		return true;
	}
}
