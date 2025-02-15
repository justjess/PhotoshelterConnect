<?php
/**
 * Photoshelter Connect plugin for Craft CMS 3.x
 *
 * Photoshelter API connector for Craft CMS
 *
 * @link      justjess.com
 * @copyright Copyright (c) 2018 Jessica D'Amico
 */

namespace justjess\photoshelterconnect\models;

use craft\base\Model;

/**
 * PhotoshelterConnect Settings Model
 *
 * This is a model used to define the plugin's settings.
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Jessica D'Amico
 * @package   PhotoshelterConnect
 * @since     1.0.0
 */
class Settings extends Model
{
  // Public Properties
  // =========================================================================

  /**
   * Some field model attribute
   *
   * @var string
   */

   public $apiKey = 'Your API Key';
   public $userId = 'Your User ID';
   public $primaryCollectionId = 'Your Primary Collection ID';
  
   public function attributeLabels()
   {
       return [
           'apiKey' => 'Your Photoshelter API Key',
           'userId' => 'Your Photoshelter User ID',
           'primaryCollectionId' => 'Your Photoshelter Primary Collection ID'
       ];
   }
   
  // Public Methods
  // =========================================================================

  /**
   * Returns the validation rules for attributes.
   *
   * Validation rules are used by [[validate()]] to check if attribute values are valid.
   * Child classes may override this method to declare different validation rules.
   *
   * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
   *
   * @return array
   */
  public function rules()
  {
      return [
          ['apiKey', 'string'],
          ['apiKey', 'default', 'value' => 'Your Photoshelter API Key'],
          ['userId', 'string'],
          ['userId', 'default', 'value' => 'Your Photoshelter User ID'],
          ['primaryCollectionId', 'string'],
          ['primaryCollectionId', 'default', 'value' => 'Your Photoshelter Primary Collection ID'],
      ];     
  }
}
