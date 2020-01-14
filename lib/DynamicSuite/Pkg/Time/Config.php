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
use DynamicSuite\Base\DSConfig;

/**
 * Class Config.
 *
 * Time class config wrapper.
 *
 * @package DynamicSuite\Package\Time
 * @property string $timestamp_format
 * @property string $time_format
 * @property string $date_format
 * @property string $empty_time
 */
class Config extends DSConfig
{

    /**
     * Timestamp print format.
     *
     * @var string
     */
    protected string $timestamp_format = 'm/d/Y \a\t g:i A';

    /**
     * Time print format.
     *
     * @var string
     */
    protected string $time_format = 'g:i A';

    /**
     * Date print format.
     *
     * @var string
     */
    protected string $date_format = 'm/d/Y';

    /**
     * Empty time format.
     *
     * @var string
     */
    protected string $empty_time = 'N/A';

    /**
     * Config constructor.
     *
     * @param string $package_id
     * @return void
     */
    public function __construct(string $package_id)
    {
        parent::__construct($package_id);
    }

}