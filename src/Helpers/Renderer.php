<?php

namespace JasonStainton\Breadcrumbs\Helpers;

class Renderer
{
	public static function renderBreadcrumbs($crumbOrArray = null)
	{
		$breadcrumbs = [];

		$prepend = config('breadcrumbs.prepended_breadcrumbs');

		if ($prepend && is_array($prepend))
		{
			foreach ($prepend as $slug => $name)
			{
				$breadcrumbs[ url($slug) ] = $name;
			}
		}

		if (!is_null($crumbOrArray))
		{
			$new_crumbs = [];

			if (
				is_object($crumbOrArray) &&
				in_array('JasonStainton\Breadcrumbs\Contracts\BreadcrumbContract', class_implements($crumbOrArray, true))
			)
			{
				$new_crumbs = $crumbOrArray->getCrumbs();
			}

			if (is_array($crumbOrArray))
			{
				$new_crumbs = $crumbOrArray;
			}

			$breadcrumbs = array_merge($breadcrumbs, $new_crumbs);
		}

		return view('breadcrumbs::breadcrumbs', compact('breadcrumbs'));
	}
}