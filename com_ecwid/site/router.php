<?php

if (class_exists('JComponentRouterBase')) {
	class EcwidRouter extends JComponentRouterBase {
		public function parse(&$segments) {
			return EcwidParseRoute($segments);
		}

		public function build(&$query) {
			return EcwidBuildRoute($query);
		}
	}
}

function EcwidBuildRoute(&$query) {
	$segments = array();
	if(isset($query['view']))
	{
		unset($query['view']);
	}
	if(isset($query['id']))
	{
		$segments[] = $query['id'];
		unset($query['id']);
	};
	return $segments;
}

function EcwidParseRoute(&$segments) {
	$vars = array();
	switch($segments[0])
	{
		case 'categories':
			$vars['view'] = 'categories';
			break;
		case 'category':
			$vars['view'] = 'category';
			$id = explode(':', $segments[1]);
			$vars['id'] = (int)$id[0];
			break;
		case 'article':
			$vars['view'] = 'article';
			$id = explode(':', $segments[1]);
			$vars['id'] = (int)$id[0];
			break;
	}
	return $vars;
}