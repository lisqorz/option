<?php

/**
 * Created by PhpStorm.
 * User: lsq
 * Date: 2018/9/12
 * Time: 下午2:40
 */
class None extends Option
{

    private function __construct()
    {
    }

    /**
     * @param null $val
     * @return Option
     */
    static public function new(): Option
    {
        return new self;
    }

    public function isNone(): bool
    {
        return true;
    }

    public function isSome(): bool
    {
        return false;
    }

    public function unwrap()
    {
        return null;
    }

    public function unwrapOr($or)
    {
        return $or;
    }

    /**
     * @param Exception $e
     * @throws Exception
     */
    public function expect(\Exception $e)
    {
        throw $e;
    }

    public function map(callable $call): Option
    {
        return None::new();
    }

    /**
     *
     * @param $default
     * @param callable $call
     * @return Object
     */
    public function mapOr($default, callable $call)
    {
        return Some::new(call_user_func($call));
    }

    public function mapOrElse(callable $default, callable $call)
    {
        return call_user_func($call, $this->val);
    }


    public function unwrapOrElse(callable $call)
    {
        return call_user_func($call);
    }

    public function andThen(callable $call)
    {
        return None::new();
    }

    public function filter(callable $call)
    {
        return None::new();
    }

    public function iterator()
    {
        return None::new();
    }
}