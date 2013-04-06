<?php
/**
 *    AK Bannerextension resource cllass;
 *    @author AK
 */
class AK_Bannerextension_Model_Mysql4_Bannerextension extends Mage_Core_Model_Mysql4_Abstract{

    public function _construct(){    
        // id is the primary key field in 'bannerextension' table.		
        $this->_init('bannerextension/bannerextension', 'id');
    }

}