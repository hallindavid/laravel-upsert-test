## laravel-upsert-test

to get started, clone/download the package.

```
composer install
npm install
npm run dev

#set up your database

php artisan migrate

php artisan serve # or host however you want
```

after this, browse to the page.

### see the logic

To see what the test logic, go to the file `app/Helpers/TestTaskHelper.php`

This should show you test1, test2, test3, test4 - it's also super easy to make your own tests.

#### test 1

this takes the new ordered array, loops through and updates each model individually.

```php
foreach ($new_order as $order) {
	TestTask::find($order['id'])->update(['sort_order' => $order['sort_order']]);
}
```


#### test 2

this test looks through the new ordered array, and checks the current collection, and only performs updates on records that have changed

```php
foreach ($new_order as $order) {
	if ($items->firstWhere('id', $order['id'])->sort_order !== $order['sort_order']) {
		TestTask::find($order['id'])->update(['sort_order' => $order['sort_order']]);
	}
}
```

#### test 3

this test uses the new upsert functionality in laravel 8

```php
TestTask::upsert($new_order, ['id'], ['sort_order']);
```

#### test 4

this test creates a giant *UNSANITZED* database update query in this format
```mysql
update test_tasks
set sort_order = CASE WHEN id = ? then 1 WHEN id = ? then 2 WHEN id = ? then 3 END
```

the code for this looks like this.

```php
$ids = [];

$cases = '';
foreach ($new_order as $task) {
	$ids[] = $task['id'];
	$cases .= sprintf(' WHEN id = %d THEN %d ', $task['id'], $task['sort_order']);
}
$build_query = sprintf("CASE %s END", $cases);

TestTask::query()->whereIn('id', $ids)->update([
	'sort_order' => DB::raw($build_query)
]);
```
