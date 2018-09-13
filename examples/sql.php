<?php
/**
 * Created by PhpStorm.
 * User: lsq
 * Date: 2018/9/13
 * Time: 上午11:58
 */
require_once "../src/Option.php";


$db = array(
    'host' => '127.0.0.1',
    'port' => '3306',
    'dbname' => 'test',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'dsn' => 'mysql:host=127.0.0.1;dbname=test;port=3306;charset=utf8',
);

//连接
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
);

try {
    $pdo = new PDO($db['dsn'], $db['username'], $db['password'], $options);
} catch (PDOException $e) {
    die('数据库连接失败:' . $e->getMessage());

}
/** @var PDO $conn */
Some(!$pdo->errorCode())->expect(new PDOException("数据库链接失败" . $pdo->errorCode()));

$statement = $pdo->query("select count(id) from link");
$cnt = 0;
if (!$statement) {
    $cnt = $statement->rowCount();
}

$cnt = Some($pdo->query("select count(id) from link"))->andThen(function ($statement) {
    return $statement->rowCount();
})->unwrapOr(0);

print_r($cnt);

$query = $pdo->query("select id,name from link");
$result = [];

if ($query) {
    $res = $query->fetchAll();
    if ($res) {
        foreach ($res as $key => $item) {
            $result[] = [
                "link_id" => $item["id"],
                "link_name" => $item["name"] ?? "匿名链接",
            ];
        }
    }
}
$result = Some($pdo->query("select id,name from link"))->andThen(function ($state) {
    return $state->fetchAll();
})->filter(function ($item) {
    return [
        "link_id" => $item["id"],
        "link_name" => Some($item["name"])->unwrapOr("匿名链接"),
    ];
})->unwrapOr([]);

print_r($result);