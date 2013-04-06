<?php
/**
 *    AK Bannerextension model class;
 *    @author AK
 */
 
class AK_Bannerextension_Model_Bannerextension extends Mage_Core_Model_Abstract {

    public function _construct()    {
        parent::_construct();
        //tell magento about module name and resource filename.it does depend on config.xml
		$this->_init('bannerextension/bannerextension');
		
    }
	
}