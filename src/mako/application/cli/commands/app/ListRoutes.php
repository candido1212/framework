<?php

/**
 * @copyright Frederic G. Østby
 * @license   http://www.makoframework.com/license
 */

namespace mako\application\cli\commands\app;

use Closure;

use mako\file\FileSystem;
use mako\http\routing\Routes;
use mako\reactor\Command;
use mako\utility\Str;

/**
 * Command that lists all registered routes.
 *
 * @author Frederic G. Østby
 */
class ListRoutes extends Command
{
	/**
	 * Make the command strict.
	 *
	 * @var bool
	 */
	protected $isStrict = true;

	/**
	 * Command information.
	 *
	 * @var array
	 */
	protected $commandInformation =
	[
		'description' => 'Lists all registered routes.',
	];

	/**
	 * Executes the command.
	 *
	 * @access public
	 * @param \mako\http\routing\Routes $routes Route collection
	 */
	public function execute(Routes $routes)
	{
		$routeCollection = [];

		// Build table rows

		foreach($routes->getRoutes() as $route)
		{
			// Normalize action name

			$action = ($route->getAction() instanceof Closure) ? 'Closure' : $route->getAction();

			// Build table row

			$routeCollection[] =
			[
				$route->getRoute(),
				implode(', ', $route->getMethods()),
				$action,
				implode(', ', $route->getMiddleware()),
				(string) $route->getName(),
			];
		}

		// Draw table

		$headers =
		[
			'<green>Route</green>',
			'<green>Allowed methods</green>',
			'<green>Action</green>',
			'<green>Middleware</green>',
			'<green>Name</green>',
		];

		$this->table($headers, $routeCollection);
	}
}
