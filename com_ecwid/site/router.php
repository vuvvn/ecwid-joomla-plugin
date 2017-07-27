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
	return array(
		'view' => 'ecwid'
	);
}
