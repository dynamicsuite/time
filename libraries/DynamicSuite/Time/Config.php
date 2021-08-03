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
use DynamicSuite\JSONConfig;

/**
 * Class Config.
 *
 * @package DynamicSuite\Time
 * @property string|null $default_timezone
 * @property string $timestamp_format
 * @property string $time_format
 * @property string $date_format
 * @property string $empty_time
 * @property string $sql_date_format
 * @property string $sql_time_format
 */
class Config extends JSONConfig
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