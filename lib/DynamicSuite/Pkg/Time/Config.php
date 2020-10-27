<?php
/**
 * Time runtime configuration.
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
use DynamicSuite\Core\GlobalConfig;

/**
 * Class Config.
 *
 * @package DynamicSuite\Pkg\Time
 * @property string|null $default_timezone
 * @property string $timestamp_format
 * @property string $time_format
 * @property string $date_format
 * @property string $empty_time
 * @property string $sql_date_format
 * @property string $sql_time_format
 */
class Config extends GlobalConfig
{

    /**
     * The default timezone to use when a timezone is not given.
     *
     * @var string|null
     */
    protected ?string $default_timezone = null;

    /**
     * Timestamp print format.
     *
     * @var string
     */
    protected string $timestamp_format = 'm/d/Y g:i A';

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
     * Date format for SQL wrapper.
     *
     * @var string
     */
    protected string $sql_date_format = '%Y/%m/%d';

    /**
     * Time format for SQL wrapper.
     *
     * @var string
     */
    protected string $sql_time_format = '%h:%i %p';

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