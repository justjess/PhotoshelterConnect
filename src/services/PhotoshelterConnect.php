<?php
/**
 * Photoshelter Connect plugin for Craft CMS 3.x
 *
 * Photoshelter API connector for Craft CMS
 *
 * @link      justjess.com
 * @copyright Copyright (c) 2018 Jessica D'Amico
 */

namespace justjess\photoshelterconnect\services;

use justjess\photoshelterconnect\PhotoshelterConnect;

use Craft;
use craft\base\Component;

/**
 * PhotoshelterConnect Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Jessica D'Amico
 * @package   PhotoshelterConnect
 * @since     1.0.0
 */
class PhotoshelterConnect extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     PhotoshelterConnect::$plugin->photoshelterConnect->exampleService()
     *
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';
        // Check our Plugin's settings for `someAttribute`
        if (PhotoshelterConnect::$plugin->getSettings()->someAttribute) {
        }

        return $result;
    }
}
