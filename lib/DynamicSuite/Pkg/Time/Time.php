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

use DynamicSuite\Core\DynamicSuite;

/**
 * Class Time.
 *
 * @package DynamicSuite\Pkg\Time
 * @property Config $cfg
 */
class Time
{

    /**
     * Time config.
     *
     * @var Config
     */
    protected Config $cfg;

    /**
     * Time constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $hash = DynamicSuite::getHash('dspkg-time-cfg');
        if (DS_CACHING && apcu_exists($hash)) {
            $this->cfg = apcu_fetch($hash);
        } else {
            $this->cfg = new Config('time');
        }
    }

    /**
     * Format a given time to RFC3339 format.
     *
     * @param string $timestamp
     * @return string
     */
    public function atom(string $timestamp = null): string
    {
        return $timestamp ? date(DATE_ATOM, strtotime($timestamp)) : $this->cfg->empty_time;
    }

    /**
     * Format a given time to the configured format.
     *
     * @param string $time
     * @return string
     */
    public function time(string $time = null): string
    {
        return $time ? date($this->cfg->time_format, strtotime($time)) : $this->cfg->empty_time;
    }

    /**
     * Format a given date to the configured format.
     *
     * @param string $date
     * @return string
     */
    public function date(string $date = null): string
    {
        return $date ? date($this->cfg->date_format, strtotime($date)) : $this->cfg->empty_time;
    }

    /**
     * Format a given timestamp to the configured format.
     *
     * @param string $timestamp
     * @return string
     */
    public function timestamp(string $timestamp = null): string
    {
        return $timestamp ? date($this->cfg->timestamp_format, strtotime($timestamp)) : $this->cfg->empty_time;
    }

}