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
 * Eventool Data Helper
 *
 * @category    KojiroMike
 * @package     KojiroMike_Eventool
 * @author      Michael A. Smith <michael@smith-li.com>
 */
class KojiroMike_Eventool_Helper_Data extends Mage_Core_Helper_Abstract
{
	/**
	 * Register an event handler on the fly.
	 *
	 * @param string $event The event name
	 * @param string $class The class factory or real name
	 * @param string $method The method name
	 * @param string $type [model, disabled, singleton]
	 * @param string $area One of the Mage_Core_Model_App_Area::AREA_* consts
	 * @param string $handler The observer node name. Leave this blank to get a guaranteed-unique randomish one.
	 * @return string The observer node name (so you can unregister the event) or empty string on failure
	 */
	public function registerObserver($event, $class, $method, $type='model', $area='global', $handler='')
	{
		//sales_quote_save_before
		$appConfig = Mage::getConfig();
		if (!$handler) {
			$pre = uniqId($class . '::' . $method);
		}
		$path = "config/$area/events/$event/observers/$handler/";
		$nodes = array(
			'type' => $type,
			'class' => $class,
			'method' => $method,
		);
		foreach ($nodes as $base => $val) {
			$appConfig->setNode($path . $base, $val);
		}
	}
	/**
	 * Disable an event handler.
	 *
	 * @param string $event The event name
	 * @param string $handler The handler name
	 * @param string $area One of the Mage_Core_Model_App_Area::AREA_* consts
	 * @return string The previous node type value (in case you want to enable it the way it was before.)
	 */
	public function disableObserver($event, $handler, $area='global')
	{
		$appConfig = Mage::getConfig();
		$path = "config/$area/events/$event/observers/$handler/type";
		$prev = (string) $appConfig->getNode($path);
		$appConfig->setNode($path, 'disabled');
		return $prev;
	}
}

