<?php
/**
 *    AK Bannerextension model class;
 *    @author AK
 */
  
class AK_Bannerextension_Model_System_Config_Source_Effects {

    public function toOptionArray(){
        return array(
            array('value' => 'horizontal', 'label'=>Mage::helper('bannerextension')->__('Slide Horizontal')),
            array('value' => 'vertical', 'label'=>Mage::helper('bannerextension')->__('Slide Vertical')),
            array('value' => 'fade', 'label'=>Mage::helper('bannerextension')->__('Fade effect'))
        );
    }
	
}