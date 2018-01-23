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

use craft\base\Component;
use http\Exception;
use justjess\photoshelterconnect\PhotoshelterConnect;

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
class DefaultService extends Component
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
     
    private $baseApiUrl = "https://www.photoshelter.com/psapi/v3/";
    private $apiKeys = array();
    private $queryKeys = array();
    private $_endpoint = '';
		
		public function getCollection($collectionId, $options = [])
    	{
        $this->_endpoint = 'collection/{{collection}}/children';
    		$this->queryKeys['collection'] = $collectionId;
    		
    		$this->queryKeys['fields'] = 'name,mode,description';
    		$this->queryKeys['per_page'] = '5';
    		$this->queryKeys['page'] = '1';
    		
    		if(isset($options['fields'])) {
    			$this->apiKeys['fields'] = $options['fields'];
    		}
    		if(isset($options['per_page'])) {
    			$this->apiKeys['per_page'] = $options['per_page'];
    		}
    		if(isset($options['page'])) {
    			$this->apiKeys['page'] = $options['page'];
    		}
    		if (isset($options['api_key'])) {
    		    $this->apiKeys['api_key'] = $options['api_key'];
    		}
    		
    		$extend['KeyImage'] = [
    			'params' => [],
    			'fields' => '*'
    		];
    
    		$ext = json_encode($extend);
    		$this->apiKeys['extend'] = $ext;
    		                        
        $response = $this->getApiResponse();
    
        if(!isset($response['Children'])) {
        	return null;
        }
         	
        return $response['Children'];
    	}
    	
  	public function getGallery($galleryId)
	    {
        $this->queryKeys['gallery'] = $galleryId;
        $this->_endpoint = 'gallery/{{gallery}}';
		             
        $response = $this->getApiResponse();

        // We really care only about the single one, so just return the first item
        if(isset($response['Gallery'])) {
            return $response['Gallery'];
        }

        return null;
	    }
  	    
	   public function getGalleryImages($galleryId, $options = [])
       {
         $this->_endpoint = 'gallery/{{gallery}}/images';
         $this->queryKeys['gallery'] = $galleryId;
 
         $this->queryKeys['imageMode'] = 'fit';
         $this->queryKeys['imageSize'] = '500x500';
         $this->queryKeys['sort_by'] = 'file_name';
         
 				 if(isset($options['imageMode'])) $this->queryKeys['imageMode'] = $options['imageMode'];
         if(isset($options['imageSize'])) $this->queryKeys['imageSize'] = $options['imageSize'];
         if(isset($options['sort_by'])) $this->apiKeys['sort_by'] = $options['sort_by'];
 
         $extend['Image'] = array('params' => array(),
                                  'fields' => 'image_id,filename');
         $extend['Iptc'] = array('params' => array(),
                                 'fields' => 'headline,author,copyright');
         $extend['ImageLink'] = array('params' => array('image_mode' => '{{imageMode}}',
                                                        'image_size' => '{{imageSize}}'),
                                     										'fields' => '*');
 
         $ext = json_encode($extend);
         $this->apiKeys['extend'] = $ext;
 
         $response = $this->getApiResponse();
 
         if(!isset($response['GalleryImage'])) return null;
 
         return $response['GalleryImage'];
       }
	       
       private function getApiResponse()
         {
           $endpoint = $this->_endpoint;
   
           // Directly add the extra api keys so we can replace them
           $keys = array();
           foreach($this->apiKeys as $key => $val) {
               $keys[] = $key.'='.$val;
           }
           $endpoint .= '?'.implode('&', $keys);
           $url = $this->baseApiUrl . $endpoint;
   
           foreach($this->queryKeys as $key => $val) {
           		$url = str_replace('{{'.$key.'}}', $val, $url);
           }
           
           $response = $this->curlGet($url);
   
           if($response == false) return null;
   
           return $response;
         }
	         
       private function curlGet($url)
         {
           try {
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_URL, $url);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
               $return = curl_exec($ch);
               $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
               curl_close($ch);
   
   
               if($httpCode == '200') {
   
                   $json = json_decode($return, true);
                   if(!isset($json['data']) || !is_array($json)) return false;
   
                   return $json['data'];
               }
   
           } catch(Exception $e) {
               return false;
           }
     
         }
      
      /**
      * Returns the photoshelterService instance
      *
      * @return DefaultService
      */
      protected function getDefaultService(): DefaultService {
      	return PhotoshelterConnect::getInstance()->photoshelterService;
      }   
}
