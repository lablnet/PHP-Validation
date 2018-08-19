<?php

/**
 * Validation.
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

class Validation
{
    protected $messages;
    protected $errors;

    public function __construct($input, $rule, $type = 'input')
    {
        $this->messages = Handler::getMsgs();
        $this->make($input, $rule, $type);
    }

    public function jsonCompile($data, $policie)
    {
        $passed = call_user_func_array([new JsonRules(), $policie], [$data]);
        if ($passed !== true) {
            Handler::set($this->messages[$policie], 'json');
        }
    }

    public function inputCompile(array $data)
    {
        foreach ($data['policies'] as $rule => $policy) {
            $passed = call_user_func_array([new InputRules(), $rule], [$data['value']]);
            if ($passed !== true) {
                Handler::set(
                    str_replace(':field', $data['field'], $this->messages[$rule]), $data['field']);
            }
        }
    }

    public function make($data, $policies, $type)
    {
        if ($type === 'input') {
            foreach ($data as $field => $value) {
                if (array_key_exists($field, $policies)) {
                    $this->inputCompile(
                        ['field' => $field, 'value' => $value, 'policies' => $policies[$field]]
                    );
                }
            }
        } elseif ($type === 'json') {
            $this->jsonCompile($data, $policies);
        } else {
			throw new \Expection("No such type support",404);
		}
    }

    public function fail()
    {
        return Handler::has();
    }

    public function error()
    {
        $this->errors = Handler::all();

        return $this;
    }

    public function has($key)
    {
        return (isset($this->errors[$key])) ? true : false;
    }

    public function get($key = null)
    {
        return (isset($key)) ? $this->errors[$key] : $this->errors;
    }

    public function last($key = null)
    {
        return end($this->get($key));
    }

    public function first($key = null)
    {
        return current($this->get($key));
    }
}
