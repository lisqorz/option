# Option


case 0 

```php
Native
try {
    $pdo = new PDO($db['dsn'], $db['username'], $db['password'], $options);
} catch (PDOException $e) {
    throw new PDOException('数据库连接失败:' . $e->getMessage());
}
```

```php 
Option
/** @var PDO $conn */
Some(!$pdo->errorCode())->expect(new PDOException("数据库链接失败" . $pdo->errorCode()));
```

```php 
Native
$statement = $pdo->query("select count(id) from link");
$cnt = 0;
if (!$statement) {
    $cnt = $statement->rowCount();
}
```

```php 
Option
$cnt = Some($pdo->query("select count(id) from link"))->andThen(function ($statement) {
    return $statement->rowCount();
})->unwrapOr(0);

print_r($cnt);
```

```php 
Native
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
```

```php 
Option
$result = Some($pdo->query("select id,name from link"))->andThen(function ($state) {
    return $state->fetchAll();
})->filter(function ($item) {
    return [
        "link_id" => $item["id"],
        "link_name" => Some($item["name"])->unwrapOr("匿名链接"),
    ];
})->unwrapOr([]);

print_r($result);
```

case 1

```php
// Option
$res = Some($db->get())->expect(new \Exception("msg"));
```

```php
// native
$res = $db->get();
if (is_null($res)) {
    throw new \Exception("msg");
}
```

case2 

```php
// Option
$_POST["hello"] = null;
Some($_POST['hello'])->unwrapOr("hi"); // hi
$_POST["hello"] = "hello";
Some($_POST['hello'])->unwrapOr("hi"); // hello

// ... but we have $_POST["hello"]??"hi" 2333
```

Case3 

```php
// scenario
$obj = new Obj();
$obj->attr = null; // attr is Object;
```



```php
// Option

// None
$attr = Some($obj->attr)->andThen(function($attr){
	return "Some Data";
})->unwrapOr("no success");

//Some
$attr = Some(1)->andThen(function($attr){
    return null;
})->unwrapOr("no success");

```

```php
// native
$attr = "no success";
if ($obj->attr) {
   $attr = (function($attr){return ""; })()
}
if (!$attr) {
    $attr = "no success";
}
```

