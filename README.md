# WP Widgets

> Control the WP widgets whilst using WP in as a headless CMS. Now widgets will output JSON data via an API rather than  


## Getting Started

The easiest way to install this package is by using composer from your terminal:

```bash
composer require moxie-lean/wp-widgets
```

Or by adding the following lines on your `composer.json` file

```json
"require": {
  "moxie-lean/wp-widgets": "dev-master"
}
```

This will download the files from the [packagist site](https://packagist.org/packages/moxie-lean/wp-widgets) 
and set you up with the latest version located on master branch of the repository. 

After that you can include the `autoload.php` file in order to
be able to autoload the class during the object creation.

```php
include '/vendor/autoload.php';
```


## Usage

You first need to register the widgets you want to use using the ```Register::init()``` function. This function takes the following parameter:

```php
[
    'lean' => [],
    'custom' => [],
]
```

Where 'lean' is the list of pre-defined widgets you want to use, and 'custom' is a list of any custom widgets you want to add for this project. For example:

```php
\Lean\Widgets\Register::init([
    'lean' => [
        'LeanPreview',
        'LeanMenu,
    ],
    'custom' => [
        'MyProject\Widgets\MyCustomWidget'
    ],
]);
```

Note that Lean widgets can be registered with their short class name, whereas custom widgets need a fully qualified namespace.
 
All custom widget objects must extend the ```\Lean\Widgets\Models\AbstractWidget``` class. See below.

You can register widget areas using the usual WordPress function:

```php
register_sidebar( array(
    'id' => 'my-sidebar',
    'name' => 'Name',
    'description' => 'My new sidebar',
) );
```

### Creating Custom Widgets

All custom widgets must extend the ```\Lean\Widgets\Models\AbstractWidget``` class. The simplest widget you can create just needs to implement the ```__construct()``` function, eg:

```php
use Lean\Widgets\Models\AbstractWidget;

class MyWidget extends AbstractWidget {
	public function __construct() {
		parent::__construct( 'My Widget', 'Displays something really cool.' );
	}
}
```

By default it will use the widget's class name as the widget slug, converting it into dash format (e.g. MyWidget becomes my-widget). If you want to override the slug you can pass it as a third argument into the ```parent::__construct()``` function.

In addition there are a couple of other functions which you may want to use:

#### Post Registration

The post registration function runs just after the widget is registered. You can use this to register ACF fields, e.g.:

```php
public static function post_registration() {
    if ( function_exists( 'acf_add_local_field_group' ) ) :
    endif;
}
```

#### Get Data

This function returns the widget's data for use in an API. By default it will return the widget's title and all ACF fields. You can override it like this:

```php
public function get_data() {
    $data = parent::get_data();
    		
    return array_merge( ['more_data' => 'something'], $data );
}
```
 
#### Widget

By default the widget will output an error message if you try to use it in a normal WordPress theme. If, however, you want to allow it to be used as a normal widget too, you can override the ```widget```function:

```php
public function widget( $args, $instance ) {
    ?>
    <h3><?php echo esc_html( $instance['title'] ? $instance['title'] : '' ) ?></h3>
    <?php
}
```
