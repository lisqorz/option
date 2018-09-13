<?php

/**
 * Created by PhpStorm.
 * User: lsq
 * Date: 2018/9/12
 * Time: 下午2:40
 */

class Some extends Option
{
    private function __construct($val)
    {
        $this->val = $val;
    }

    public static function new($val)
    {
        if ($val instanceof None) {
            return $val;
        }
        if (!is_null($val) || false !== $val) {
            return new self($val);
        }
        return None::new();
    }

    public function isNone(): bool
    {
        return false;
    }

    public function isSome(): bool
    {
        return true;
    }

    public function unwrap()
    {
        return $this->val;
    }

    public function unwrapOr($or)
    {
        return $this->val;
    }

    public function expect($msg)
    {
        return $this->val;
    }

    public function map(callable $call): Option
    {
        return Some::new(call_user_func($call, $this->val));
    }

    public function mapOr($default, callable $call)
    {
        return $default;
    }

    public function mapOrElse(callable $default, callable $call)
    {
        return call_user_func($call, $this->val);
    }

    public function unwrapOrElse(callable $call)
    {
        return $this->val;
    }

    public function andThen(callable $call)
    {
        return Some::new(call_user_func($call, $this->val));
    }

    public function filter(callable $call)
    {
        $ret = [];
        foreach ($this->iterator() as $k => $v) {
            (Some::new(call_user_func($call, $v)))->map(function ($val) use (&$ret) {
                $ret[] = $val;
            });
        }
        return Some::new($ret);
    }

    public function iterator()
    {
        if (is_iterable($this->val)) {
            return new ArrayIterator($this->val);
        }
        return new ArrayIterator([$this->val]);
    }
}