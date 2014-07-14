<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    KojiroMike
 * @package     KojiroMike_Eventool
 * @copyright   Copyright (c) 2014 Michael A. Smith
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Eventool Callback Registrar
 *
 * @category    KojiroMike
 * @package     KojiroMike_Eventool
 * @author      Michael A. Smith <michael@smith-li.com>
 */
class KojiroMike_Eventool_Model_Callback
{
	/** @var array $callbacks array of callables that you can use as arbitrary observers. */
	protected $callbacks = array();

	/**
	 * Register a callable as a member of this singleton
	 *
	 * @param string $name The name of the callback
	 * @param callable $callback The callable to call
	 * @return self
	 */
	public function addCallback($name, $callback)
	{
		$this->callbacks[$name] = $callback;
	}

	/**
	 * Call a registered callback
	 */
	public function call($name, array $arguments)
	{
		return call_user_func_array($this->callbacks[$name], $arguments);
	}

	/**
	 * Call a registered callback as a method of this singleton
	 */
	public function __call($name, array $arguments)
	{
		return $this->call($name, $arguments);
	}
}

