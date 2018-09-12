# Option



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
	return "";
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

