<?php

/**
 * @copyright Frederic G. Østby
 * @license   http://www.makoframework.com/license
 */

namespace mako\cache\stores;

use mako\cache\stores\StoreInterface;

/**
 * Base store.
 *
 * @author Frederic G. Østby
 */
abstract class Store implements StoreInterface
{
	/**
	 * Prefix.
	 *
	 * @var null|string
	 */
	protected $prefix;

	/**
	 * Sets the cache key prefix.
	 *
	 * @access public
	 * @param  string                   $prefix Prefix
	 * @return \mako\cache\stores\Store
	 */
	public function setPrefix(string $prefix)
	{
		$this->prefix = $prefix;

		return $this;
	}

	/**
	 * Returns the cache key prefix.
	 *
	 * @access public
	 * @return null|string
	 */
	public function getPrefix()
	{
		return $this->prefix;
	}

	/**
	 * Returns a prefixed key.
	 *
	 * @access protected
	 * @param  string $key Key
	 * @return string
	 */
	protected function getPrefixedKey(string $key): string
	{
		return empty($this->prefix) ? $key : $this->prefix . '.' . $key;
	}

	/**
	 * Fetch data from the cache and replace it.
	 *
	 * @access public
	 * @param  string $key  Cache key
	 * @param  mixed  $data The data to store
	 * @param  int    $ttl  Time to live
	 * @return mixed
	 */
	public function getAndPut(string $key, $data, int $ttl = 0)
	{
		$key = $this->getPrefixedKey($key);

		$storedValue = $this->get($key);

		$this->put($key, $data, $ttl);

		return $storedValue;
	}

	/**
	 * Fetch data from the cache and remove it.
	 *
	 * @access public
	 * @param  string $key Cache key
	 * @return mixed
	 */
	public function getAndRemove(string $key)
	{
		$key = $this->getPrefixedKey($key);

		$storedValue = $this->get($key);

		if($storedValue !== false)
		{
			$this->remove($key);
		}

		return $storedValue;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getOrElse(string $key, callable $data, int $ttl = 0)
	{
		$key = $this->getPrefixedKey($key);

		if(!$this->has($key))
		{
			$data = $data();

			$this->put($key, $data, $ttl);

			return $data;
		}

		return $this->get($key);
	}
}
