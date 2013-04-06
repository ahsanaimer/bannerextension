<?php
/**
 *    AK Bannerextension collection cllass;
 *    @author AK
 */
 
class AK_Bannerextension_Model_Mysql4_Bannerextension_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct(){
        parent::_construct();
        $this->_init('bannerextension/bannerextension'); //tell magento about frontend model and resource model
    }
}