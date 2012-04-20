<?php

/** @file
 * This file is part of Google Chart PHP library.
 *
 * Copyright (c) 2010 Rémi Lanvin <remi@cloudconnected.fr>
 *
 * Licensed under the MIT license.
 *
 * For the full copyright and license information, please view the LICENSE file.
 */

include_once dirname(__FILE__).'/../GoogleChartMarker.php';

/**
 * A Range marker.
 *
 * This class implement Range Markers feature (@c chm).
 *
 * @par Example
 *
 *
 * @see GoogleChartMarker
 * @see http://code.google.com/apis/chart/docs/chart_params.html#gcharts_range_markers
 */
class GoogleChartRangeMarker extends GoogleChartMarker {
	
	protected $direction;
	
	/**
	* Set direction for the range.
	*
	* @param $direction = 'r' (r == horizontal, R == vertical)
	* @return $this
	*/
	public function setDirection($direction = 'r'){
		if($direction == 'r' || $direction == 'R')
			$this->direction = $direction;
		else
			throw new LogicException('Range marker range must be "r" or "R".');

		return $this;
	}
	
	protected $points;
	/**
	* Set start and stop points for the range.
	*
	* @param $start (between 0.0 and 1.0)
	* @param $stop (between 0.0 and 1.0)
	* @return $this
	*/
	public function setPoints($start = null, $stop = null)
	{
		if ( $start === null || $stop === null ) {
						throw new LogicException('Range marker range must have 2 points.');
		}
		else {
			$this->points = array(
					'start' => $start,
					'stop' => $stop
			);
		}
		return $this;
	}
	
	/**
	 * Compute the parameter value.
	 *
	 * @note For internal use only.
	 * @param $index (int) index of the data serie.
	 * @return string
	 */
	public function compute($index)
	{
		$points = '0,0';
		if ( is_array($this->points) ) {
			$points = $this->points['start'].','.$this->points['stop'];
		}
		
		$str = sprintf(
					'%s,%s,%d,%s',
		$this->direction,
		$this->color,
		0,
		$points
		);
				
		return $str;
		
	}
}
