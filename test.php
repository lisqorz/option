<?php
/**
 * Created by PhpStorm.
 * User: lsq
 * Date: 2018/9/12
 * Time: 下午3:59
 */

require_once 'Option.php';
function retA($v)
{
    if ($v == 'a') {
        return $v;
    }
}

echo "======call Filter======\n";
$filter = Some(["a", "b", "c"])->filter('retA')->unwrap();
print_r($filter);

echo "======call null Filter======\n";
$nullFilter = Some(null)->filter('retA')->unwrap();
print_r($nullFilter);

echo "======call Map======\n";
$map = Some("nihao\n")->map("strtoupper")->unwrap();
echo "result:" . $map . PHP_EOL;

echo "======call null Map======\n";
$nullMap = Some(null)->map("strtoupper")->unwrapOr("NIHAO");
echo "result:" . $nullMap . PHP_EOL;

echo "====== test andThen ======\n";
function sq($x)
{
    echo "invoke" . PHP_EOL;
    return 2 * 2;
}

echo "result:" . Some(0)->andThen('sq')->andThen('sq')->unwrap() . PHP_EOL;

echo "====== test None andThen ======\n";
function nullSq($x)
{
    echo "return None break andThen" . PHP_EOL;
    return None::new();
}

echo "result:" . Some(0)->andThen('nullSq')->andThen('nullSq')->unwrap() . PHP_EOL;

echo "====== test iterator======\n";
print_r(Some("hello")->iterator());

echo "====== test None iterator======\n";
print_r(Some(null)->iterator());

echo "====== test expect======\n";
echo "result:" . Some("msg")->expect(new LogicException("got null")) . PHP_EOL;

echo "====== test null expect ======\n";
//echo "will be throw exception" . Some(null)->expect(new LogicException("got null"));
