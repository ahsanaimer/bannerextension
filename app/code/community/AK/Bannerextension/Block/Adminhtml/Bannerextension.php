<?php

/**
 *    AK Bannerextension main admin block
 *    @author AK
 */
  
class AK_Bannerextension_Block_Adminhtml_Bannerextension extends Mage_Adminhtml_Block_Widget_Grid_Container{

  public function __construct(){
    $this->_controller = 'adminhtml_bannerextension'; // is path to block class 
    $this->_blockGroup = 'bannerextension'; //is module name 
    $this->_headerText = Mage::helper('bannerextension')->__('Manage Banner');
    $this->_addButtonLabel = Mage::helper('bannerextension')->__('Add New Banner');	
    parent::__construct();
	//$this->removeButton('add');
  }
  
}