<?php

/**
 * JsonRules.
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

class JsonRules extends StickyRules
{
    public function validate($value)
    {
        if ($this->notBeEmpty($value)) {
            $value = json_decode($value);
            if ($value !== null) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
