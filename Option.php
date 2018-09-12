<?php
/**
 * Created by PhpStorm.
 * User: lsq
 * Date: 2018/9/10
 * Time: 上午11:49
 */
require_once 'None.php';
require_once 'Some.php';

abstract class Option
{
    protected $val = null;

    private function __construct()
    {
    }

    /**
     * @return bool
     */
    abstract public function isNone(): bool;

    /**
     * @return bool
     */
    abstract public function isSome(): bool;

    /**
     * return this.val
     * @return Object
     */
    abstract public function unwrap();

    /**
     * return $or if this.val is null else this.val
     * @param $or
     * @return Object
     */
    abstract public function unwrapOr($or);

    /**
     * invoke and return $call if this.val is null else return this.val
     * @param callable $call
     * @return Object
     */
    abstract public function unwrapOrElse(callable $call);

    /**
     * throw Exception if this.val is null else return this.val
     * @param Exception $e
     * @return mixed
     */
    abstract public function expect(\Exception $e);

    /**
     * @param callable $call
     * @return Option
     */
    abstract public function map(callable $call): Option;

    /**
     * return default if this.val is null else invoke and return call(this.val)
     * @param $default
     * @param callable $call
     * @return Object
     */
    abstract public function mapOr($default, callable $call);

    /**
     * invoke and return $default() if this.val is null else invoke and return $call(this.val)
     * @param callable $default
     * @param callable $call
     * @return Object
     */
    abstract public function mapOrElse(callable $default, callable $call);

    abstract public function andThen(callable $call);

    abstract public function filter(callable $call);

    abstract public function iterator();
}

function Some($val)
{
    return Some::new($val);
}

function None()
{
    return None::new();
}