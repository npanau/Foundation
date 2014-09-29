<?php
/*
 * This file is part of the Pomm package.
 *
 * (c) 2014 Grégoire HUBERT <hubert.greg@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PommProject\Foundation\Converter;

use PommProject\Foundation\Converter\ConverterInterface;
use PommProject\Foundation\Session;

/**
 * PgTimestamp
 *
 * Date and timestamp converter
 *
 * @package Foundation
 * @copyright 2014 Grégoire HUBERT
 * @author Grégoire HUBERT <hubert.greg@gmail.com>
 * @license X11 {@link http://opensource.org/licenses/mit-license.php}
 */
class PgTimestamp implements ConverterInterface
{
    /**
     * @see ConverterInterface
     */
    public function fromPg($data, $type, Session $session)
    {
        $data = trim($data);

        return $data !== 'NULL' ? new \DateTime($data) : null;
    }

    /**
     * @see ConverterInterface
     */
    public function toPg($data, $type, Session $session = null)
    {
        if ($data === null) return sprintf("NULL::%s", $type);

        if (!$data instanceof \DateTime) {
            $data = new \DateTime($data);
        }

        return sprintf("%s '%s'", $type, $data->format('Y-m-d H:i:s.uP'));
    }
}