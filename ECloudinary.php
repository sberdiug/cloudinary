<?php

/**
 * ECloudinary class file.
 *
 * @author VINAY KUMAR SHARMA <vinaykrsharma@live.in>
 * @version 1.0
 * @link http://www.vinay-sharma.com/cloudinary
 * @copyright Copyright &copy; 2013 VINAY KUMAR SHARMA <vinaykrsharma@live.in>
 *
 * Copyright 2013 VINAY KUMAR SHARMA <vinaykrsharma@live.in>
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * For third party licenses and copyrights, please see cloudinary/LICENSE
 *
 */
/**
 * Include the the Cloudinary provided component classes.
 */
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Cloudinary.php');
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Uploader.php');
require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Api.php');

/**
 * ECloudinary is a simple wrapper for the Cloudinary library.
 * @see http://www.vinay-sharma.com/cloudinary
 *
 * @author VINAY KUMAR SHARMA <vinaykrsharma@live.in>
 * @package application.extensions.cloudinary 
 * @since 1.0
 */
class ECloudinary extends Cloudinary {

    //***************************************************************************
    // Configuration
    //***************************************************************************
    // ACCOUNT DETAILS
    /**
     * @var String unique cloudname
     */
    public $cloud_name;

    /**
     * @var String unique api key
     */
    public $api_key;

    /**
     * @var String api secret
     */
    public $api_secret;
    //
    // NETWORK DELIVERY DETAILS
    public $base_delivery_url = 'http://res.cloudinary.com/';
    public $secure_delivery_url = 'https://res.cloudinary.com/';
    public $api_base_url = 'https://api.cloudinary.com/v1_1/';

    //***************************************************************************
    // Initialization
    //***************************************************************************

    /**
     * Constructor. Here the instance of PHPMailer is created.
     */
    public function __construct() {
        
    }

    /**
     * Init method for the application component mode.
     */
    public function init() {
        if (empty($this->cloud_name) || empty($this->api_key) || empty($this->api_secret)) {
            throw new Exception(500, "All three fields(`cloud_name`, `api_key`, `api_secret`) are mandatory!");
        }

        $this->base_delivery_url .= $this->cloud_name;
        $this->secure_delivery_url .= $this->cloud_name;
        $this->api_base_url .= $this->cloud_name;

        \Cloudinary::config(array(
            'cloud_name' => $this->cloud_name,
            'api_key' => $this->api_key,
            'api_secret' => $this->api_secret,
        ));
    }

    //***************************************************************************
    // Cloudinary Library methods call
    //***************************************************************************
    public function upload($file, $options = array()) {
        return \Cloudinary\Uploader::upload($file, $options);
    }

    //***************************************************************************
    // Magic
    //***************************************************************************

    /**
     * Call a PHPMailer function
     *
     * @param string $method the method to call
     * @param array $params the parameters
     * @return mixed
     */
    public function __call($method, $params) {
        if (is_object($this->_myMailer) && get_class($this->_myMailer) === 'PHPMailer') {
            return call_user_func_array(array($this->_myMailer, $method), $params);
        } else {
            throw new CException(Yii::t('ECloudinary', 'Can not call a method of a non existent object'));
        }
    }

    /**
     * Setter
     *
     * @param string $name the property name
     * @param string $value the property value
     */
    public function __set($name, $value) {
        if (is_object($this->_myMailer) && get_class($this->_myMailer) === 'PHPMailer') {
            $this->_myMailer->$name = $value;
        } else {
            throw new CException(Yii::t('ECloudinary', 'Can not set a property of a non existent object'));
        }
    }

    /**
     * Getter
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name) {
        if (is_object($this->_myMailer) && get_class($this->_myMailer) === 'PHPMailer') {
            return $this->_myMailer->$name;
        } else {
            throw new CException(Yii::t('ECloudinary', 'Can not access a property of a non existent object'));
        }
    }

    /**
     * Cleanup work before serializing.
     * This is a PHP defined magic method.
     * @return array the names of instance-variables to serialize.
     */
    public function __sleep() {
        
    }

    /**
     * This method will be automatically called when unserialization happens.
     * This is a PHP defined magic method.
     */
    public function __wakeup() {
        
    }

}
