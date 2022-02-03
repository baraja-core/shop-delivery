<?php

declare(strict_types=1);

namespace Baraja\Shop\Delivery;


final class Distance
{
	/**
	 * Calculate the shortest distance of two points on the Earth's surface as the crow flies.
	 */
	public static function getDistanceFrom(
		float $latitude,
		float $longitude,
		float $fromLatitude,
		float $fromLongitude,
	): float {
		static $greatCircleRadius = 6_372.795;

		return acos(
				cos(deg2rad($fromLatitude)) * cos(deg2rad($fromLongitude)) * cos(deg2rad($latitude)) * cos(deg2rad($longitude))
				+ cos(deg2rad($fromLatitude)) * sin(deg2rad($fromLongitude)) * cos(deg2rad($latitude)) * sin(deg2rad($longitude))
				+ sin(deg2rad($fromLatitude)) * sin(deg2rad($latitude)),
			) * $greatCircleRadius;
	}
}
