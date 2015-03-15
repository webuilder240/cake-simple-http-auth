## cake-simple-http-auth
SimpleHttpAuthenticationPlugin for CakePHP

This plugin is only Basic Authentication now

### How to Install

``` json
{
  "require": {
    "webuilder240/cake-simple-http-auth": "0.0.1"
  }
}
```


### How to Use

Set Setting in bootstrap.php

app/Config/bootstrap.php

``` php 

<?php

    CakePlugin::load('SimpleHttpAuth');
    
    Configure::write('SimpleHttpAuth.Config',[
        'stg' => [
            'user' => 'test',
            'password' => 'test',
        ],
    ]);
```

your AppController.php

app/Controller/AppController.php

``` php

<?php

	App::uses('Controller','Controller');

	class AppController extends Controller 
	{
		public $components = [
			'SimpleHttpAuth.Basic',
		];
	
```

### About this plugin

see the http://webuilder240.github.io/2015/03/cake-simple-http-auth/