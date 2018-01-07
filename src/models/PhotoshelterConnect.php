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

use justjess\photoshelterconnect\PhotoshelterConnect;

use Craft;
use craft\base\Model;

/**
 * PhotoshelterConnect Model
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
class PhotoshelterConnect extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * Some model attribute
     *
     * @var string
     */
    public $apiKey;
    public $userId;
    public $primaryCollectionId;
    
    public function attributeLabels ()
        {
            return [
                'apiKey' => 'Your Photoshelter API Key' ,
                'UserId' => 'Your Photoshelter User ID' ,
                'primaryCollectionId' => 'Your Photoshelter Primary Collection ID'
            ];
        }
    
    // public $someAttribute = 'Some Default';

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
            ['UserId', 'string'],
            ['UserId', 'default', 'value' => 'Your Photoshelter User ID'],
            ['primaryCollectionId', 'string'],
            ['primaryCollectionId', 'default', 'value' => 'Your Photoshelter Primary Collection ID'],
        ];
    }
}
