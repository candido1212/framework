<?php

/**
 * @copyright Frederic G. Østby
 * @license   http://www.makoframework.com/license
 */

namespace mako\database\query;

/**
 * Raw SQL container.
 *
 * @author Frederic G. Østby
 */
class Raw
{
	/**
	 * Raw SQL
	 *
	 * @var string
	 */
	protected $sql;

	/**
	 * Parameters.
	 *
	 * @var array
	 */
	protected $parameters = [];

	/**
	 * Constructor.
	 *
	 * @access public
	 * @param string $sql        Raw SQL
	 * @param array  $parameters Parameters
	 */
	public function __construct(string $sql, array $parameters = [])
	{
		$this->sql = $sql;

		$this->parameters = $parameters;
	}

	/**
	 * Returns the raw SQL.
	 *
	 * @access public
	 * @return string
	 */
	public function get(): string
	{
		return $this->sql;
	}

	/**
	 * Returns the parameters.
	 *
	 * @access public
	 * @return array
	 */
	public function getParameters(): array
	{
		return $this->parameters;
	}
}
