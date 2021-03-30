<?php
/**
 * Time core.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation version 3.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software Foundation,
 * Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301  USA
 *
 * @package AUI
 * @author Grant Martin <commgdog@gmail.com>
 * @copyright  2020 Dynamic Suite Team
 * @noinspection PhpUnused
 */

namespace DynamicSuite\Pkg\Time;

/**
 * Class Time.
 *
 * @package DynamicSuite\Pkg\Time
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
        $hash = md5(__FILE__);
        if (DS_CACHING && apcu_exists($hash)) {
            self::$cfg = apcu_fetch($hash);
        } else {
            self::$cfg = new Config('time');
            if (DS_CACHING) {
                apcu_store($hash, self::$cfg);
            }
        }
    }

    /**
     * Format a given time to RFC3339 format.
     *
     * @param int|string|null $timestamp
     * @return string
     */
    public static function atom($timestamp = null): string
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
    public static function time($time = null): string
    {
        if (!self::$cfg) {
            self::init();
        }
        if (!is_int($time) && !$time !== null) {
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
    public static function date($date = null): string
    {
        if (!self::$cfg) {
            self::init();
        }
        if (!is_int($date) && !$date !== null) {
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
    public static function timestamp($timestamp = null): string
    {
        if (!self::$cfg) {
            self::init();
        }
        if (!is_int($timestamp) && !$timestamp !== null) {
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
    public static function asInt($time = null): int
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
    public static function since($since = null): string
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

}