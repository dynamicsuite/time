<?php
/*
 * Time Package
 * Copyright (C) 2020 Dynamic Suite Team
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
 */

/** @noinspection PhpUnused */

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
     * @var Config
     */
    protected static ?Config $cfg = null;

    /**
     * Initialize the class configuration.
     *
     * @return void
     */
    public static function init(): void
    {
        $hash = md5(__DIR__);
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
     * @param string $timestamp
     * @return string
     */
    public static function atom(string $timestamp = null): string
    {
        if (!self::$cfg) {
            self::init();
        }
        return $timestamp
            ? date(DATE_ATOM, strtotime($timestamp))
            : self::$cfg->empty_time;
    }

    /**
     * Format a given time to the configured format.
     *
     * @param string $time
     * @return string
     */
    public static function time(string $time = null): string
    {
        if (!self::$cfg) {
            self::init();
        }
        return $time
            ? date(self::$cfg->time_format, strtotime($time))
            : self::$cfg->empty_time;
    }

    /**
     * Format a given date to the configured format.
     *
     * @param string $date
     * @return string
     */
    public static function date(string $date = null): string
    {
        if (!self::$cfg) {
            self::init();
        }
        return $date
            ? date(self::$cfg->date_format, strtotime($date))
            : self::$cfg->empty_time;
    }

    /**
     * Format a given timestamp to the configured format.
     *
     * @param string $timestamp
     * @return string
     */
    public static function timestamp(string $timestamp = null): string
    {
        if (!self::$cfg) {
            self::init();
        }
        return $timestamp
            ? date(self::$cfg->timestamp_format, strtotime($timestamp))
            : self::$cfg->empty_time;
    }

}