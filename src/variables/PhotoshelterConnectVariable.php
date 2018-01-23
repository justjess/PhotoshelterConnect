<?php
/**
 * Photoshelter Connect plugin for Craft CMS 3.x
 *
 * Photoshelter API connector for Craft CMS
 *
 * @link      justjess.com
 * @copyright Copyright (c) 2018 Jessica D'Amico
 */

namespace justjess\photoshelterconnect\variables;

use justjess\photoshelterconnect\PhotoshelterConnect;

use Craft;

/**
 * Photoshelter Connect Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.photoshelterConnect }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    Jessica D'Amico
 * @package   PhotoshelterConnect
 * @since     1.0.0
 */
class PhotoshelterConnectVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.photoshelterConnect.exampleVariable }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.photoshelterConnect.exampleVariable(twigValue) }}
     *
     * @param null $optional
     * @return string
     */
    public function exampleVariable($optional = null)
    {
        $result = "And away we go to the Twig template...";
        if ($optional) {
            $result = "I'm feeling optional today...";
        }
        return $result;
    }

		public function siteId()
	    {
	        return Craft::$app->sites->currentSite->id;
	    }
	    
	  public function ApiKey()
	  {
	      return photoshelterConnect::getInstance()->getSettings()->apiKey;
	  }
	  public function UserId()
	  {
	      return photoshelterConnect::getInstance()->getSettings()->userId;
	  }
	  
	  public function primaryCollectionId()
	  {
	      return photoshelterConnect::getInstance()->getSettings()->primaryCollectionId;
	  }
	  public function collection($options = [])
	  {
	      if(!isset($options['collectionId'])) {
	      	return null;
	      }
	      
	      return photoshelterConnect::getDefaultService()->getCollection($options['collectionId'], $options);
	  }
    public function gallery($galleryId)
    {
        return photoshelterConnect::getDefaultService()->getGallery($galleryId);
    }

    public function galleryImages($options = [])
    {
        if(!isset($options['galleryId'])) {
        	return null;
        }

        return photoshelterConnect::getDefaultService()->getGalleryImages($options['galleryId'], $options);
    }

    public function image($options = [])
    {
        // @todo
    }
}
