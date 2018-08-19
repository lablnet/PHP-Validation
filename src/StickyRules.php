<?php

/**
 * StickyRules.
 *
 * @author   Malik Umer Farooq <lablnet01@gmail.com>
 * @author-profile https://www.facebook.com/malikumerfarooq01/
 *
 * For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 *
 * @license MIT
 */

namespace Lablnet;

class StickyRules
{
    public function notBeEmpty($value)
    {
        return (!empty($value)) ? true : false;
    }

    public function removeSpaces($value)
    {
        return $this->escape($value,'secured');
    }
    public static function escape($input, $type)
    {
        if (!empty($input)) {
            if (!empty($type)) {
                if ($type === 'secured') {
                    return  stripslashes(trim(htmlspecialchars(htmlspecialchars($input, ENT_HTML5), ENT_QUOTES)));
                } elseif ($type === 'root') {
                    return  stripslashes(trim(htmlspecialchars(htmlspecialchars(strip_tags($input), ENT_HTML5), ENT_QUOTES)));
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }	
}
