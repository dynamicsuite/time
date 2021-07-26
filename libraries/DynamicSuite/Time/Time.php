<?php
/**
 * This file is part of the Dynamic Suite Time package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package DynamicSuite\Time
 * @author Grant Martin <commgdog@gmail.com>
 * @copyright 2021 Dynamic Suite Team
 * @noinspection PhpUnused
 */

namespace DynamicSuite\Time;

/**
 * Class Time.
 *
 * @package DynamicSuite\Time
 */
final class Time
{

    /**
     * Time config.
     *
     * @var Config|null
     */
    public static ?Config $cfg = null;

    /**
     * Initialize the class configuration.
     *
     * @return void
     */
    public static function init(): void
    {
        self::$cfg = new Config('time');
    }

    /**
     * Format a given time to RFC3339 format.
     *
     * @param int|string|null $timestamp
     * @return string
     */
    public static function atom(int | string | null $timestamp = null): string
    {
        if (!self::$cfg) {
            self::init();
        }
        if (!is_int($timestamp) && !$timestamp !== null) {
            $timestamp = strtotime($timestamp);
        }
        return $timestamp ? date(DATE_ATOM, $timestamp) : self::$cfg->empty_time;
    }

    /**
     * Format a given time to the configured format.
     *
     * @param int|string|null $time
     * @return string
     */
    public static function time(int | string | null $time = null): string
    {
        if (!self::$cfg) {
            self::init();
        }
        if (!is_numeric($time) && !$time !== null) {
            $time = strtotime($time);
        }
        return $time ? date(self::$cfg->time_format, $time) : self::$cfg->empty_time;
    }

    /**
     * Format a given date to the configured format.
     *
     * @param int|string|null $date
     * @return string
     */
    public static function date(int | string | null $date = null): string
    {
        if (!self::$cfg) {
            self::init();
        }
        if (!is_numeric($date) && !$date !== null) {
            $date = strtotime($date);
        }
        return $date ? date(self::$cfg->date_format, $date) : self::$cfg->empty_time;
    }

    /**
     * Format a given timestamp to the configured format.
     *
     * @param int|string|null $timestamp
     * @return string
     */
    public static function timestamp(int | string | null $timestamp = null): string
    {
        if (!self::$cfg) {
            self::init();
        }
        if (!is_numeric($timestamp) && !$timestamp !== null) {
            $timestamp = strtotime($timestamp);
        }
        return $timestamp ? date(self::$cfg->timestamp_format, $timestamp) : self::$cfg->empty_time;
    }

    /**
     * Get a string time/date/timestamp as an int for storage.
     *
     * @param int|string|null $time
     * @return int
     */
    public static function asInt(int | string | null $time = null): int
    {
        if (!self::$cfg) {
            self::init();
        }
        if ($time === null) {
            return time();
        } elseif (!is_int($time)) {
            return strtotime($time);
        } else {
            return $time;
        }
    }

    /**
     * Get a nicely formatted "time since" string.
     *
     * @param int|string|null $since
     * @return string
     */
    public static function since(int | string | null $since = null): string
    {
        if (!self::$cfg) {
            self::init();
        }
        if (!is_int($since) && !$since !== null) {
            $since = strtotime($since);
        }
        if (!$since) {
            return self::$cfg->empty_time;
        }
        $since = time() - $since;
        $chunks = [
            [31536000, 'year'],
            [2592000, 'month'],
            [604800, 'week'],
            [86400, 'day'],
            [3600, 'hour'],
            [60, 'minute'],
            [1, 'second']
        ];
        $name = '';
        $count = 0;
        for ($i = 0; $i < 7; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            $count = (int) floor($since / $seconds);
            if ($count !== 0) {
                break;
            }
        }
        return $count == 1 ? "1 $name" : "$count {$name}s";
    }

    /**
     * Compare two dates.
     *
     * If the second date is not given or null, the current date will be used for this value.
     *
     * Return values if:
     *   1 - Date #1 is greater than Date #2
     *  -1 - Date #1 is less than Date #2
     *   0 - Both dates are equal
     *
     * @param int|string $date_1
     * @param int|string|null $date_2
     * @return int
     */
    public static function dateCompare(int|string $date_1, int|string|null $date_2 = null): int
    {
        if ($date_2 === null) {
            $date_2 = date('Y-m-d');
        }
        $date_1 = is_string($date_1) ? strtotime(date('Y-m-d', strtotime($date_1))) : strtotime(date('Y-m-d', $date_1));
        $date_2 = is_string($date_2) ? strtotime(date('Y-m-d', strtotime($date_2))) : strtotime(date('Y-m-d', $date_2));
        if ($date_1 > $date_2) {
            return 1;
        } elseif ($date_1 < $date_2) {
            return -1;
        } else {
            return 0;
        }
    }

    /**
     * Get the integer representation of a date.
     *
     * @param int|string|null $date
     * @return int|null
     */
    public static function toIntDate(int|string|null $date): int|null
    {
        if (!$date) {
            return null;
        }
        return strtotime(date('Y-m-d', is_string($date) ? strtotime($date) : $date));
    }

}