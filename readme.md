# PHP validation

## Requirement

- PHP
- Composer

## install
run this command
``` composer ```

## usage

```php
<?php 
    require __DIR__.'/vendor/autoload.php'; 

	$rules = [
		'username' => ['required' => true, ],
		'email' => ['required' => true],
		'password' => ['required' => true, ],
	];
	$validation = new \Lablnet\Validation($_POST,$rules,'input');
	if($validation->fail()){
		$errors = $validation->error()->get();

		foreach ($errors as $error) {
			foreach ($error as $value) {
				echo $value."<br>";
			}
		}
	} else {
		//TO-Do create the user
    }
```    
