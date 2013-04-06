<?php
/**
 *    AK Bannerextension helper class
 *    @author AK
 */

class AK_Bannerextension_Helper_Data extends Mage_Core_Helper_Abstract{
	
	//Status values for dropdownlist
	public function getStatusFields(){	
		return array(1=>$this->__('Enabled'),0=>$this->__('Disabled'));	  
	}	
}
