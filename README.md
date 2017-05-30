# Laravel breadcrumb generator

Easily generate breadcrumbs from a model or view.

## Installation

Add the following to the `composer.json` file in your project:

    "jasonstainton/breadcrumbs": "1.*"

or you can run the below on the command line in the root of your project:

    composer require jasonstainton/breadcrumbs "1.*"

Add the service provider to the providers array in `config/app.php`.

	'providers' => [
	    // ...
	    JasonStainton\Breadcrumbs\Providers\BreadcrumbsServiceProvider::class,
	],

## The breadcrumbs directive

	@breadcrumbs()

Usually you would add this to a partial that is included wherever you would like your breadcrumbs to display.

## Implementation

You can add breadcrumbs dynamically to a model or manually on a view. Each method expects an array to be returned with the crumbs you would like to add. The key should be a fully qualified url *(`http://www.`)* with a string value containing the text you would like to be displayed.

### Via a Model

Implement the breadcrumb contract on your model.

	use JasonStainton\Breadcrumbs\Contracts\BreadcrumbContract;

	class Model implements BreadcrumbContract
	{
		...

This will require you to add a `getCrumbs()` method to your model and expects an array to be returned.

	public function getCrumbs()
	{
		return [
			'http://www.example.com/page' => 'Example Crumb',
			route('blog') => 'Blog',
			$this->url => $this->title
		];
	}

Now all you need to do is pass your model into the breadcrumbs directive.

	@breadcrumbs($model)

### Via a View 

You can manually set breadcrumbs in the directive if you are not using a model. Again an array is all you need to pass in.

	@breadcrumbs([
		'http://www.example.com/page' => 'Example Crumb',
		route('blog') => 'Blog'
	])

## Configuration

To use a custom template or alter any prepended crumbs run this command line in the root of your project:

	$ php artisan vendor:publish --provider="JasonStainton\Breadcrumbs\Providers\BreadcrumbsServiceProvider"

To publish just the views or config files you can add the following tags to the command

	$ php artisan vendor:publish --provider="JasonStainton\Breadcrumbs\Providers\BreadcrumbsServiceProvider" --tag="config"

	$ php artisan vendor:publish --provider="JasonStainton\Breadcrumbs\Providers\BreadcrumbsServiceProvider" --tag="views"

### Custom template

You can easilly edit the breadcrumbs appearance however you like. After publishing the views assets you will find a breadcrumb view that is returned when the breadcrumbs directive is called.

	/resources/views/vendor/breadcrumbs/breadcrumbs.blade.php

	@if(isset($breadcrumbs))

		@foreach($breadcrumbs as $url => $name)

			@if($url == url()->current())

				<span>{{ $name }}</span>

			@else

				<a href="{{ $url }}">{{ $name }}</a> &raquo;

			@endif

		@endforeach

	@endif

### Prepended crumbs

By default the breadcrumbs are always returned with a home link crumb. You can remove this to give you the most felxibility when calling breadcrumbs or add to. After publishing the packages config file you can remove the home link or add more to it.

	/config/breadcrumbs.php

	'prepended_breadcrumbs' => [
		'/' => 'Home'
	],

An array is expected to be returned. So if you want to remove the home crumb just return an empty array.
