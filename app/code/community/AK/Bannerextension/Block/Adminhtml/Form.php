<?php

/**
 *    AK Bannerextension form block
 *    @author AK
 */
 
class AK_Bannerextension_Block_Adminhtml_Form extends Mage_Core_Block_Template{
  	
  private $_activeBanner='';
  
  //Get the banner id and load the banner in constructor	
  public function __construct(){
    $_bannerId=$this->getRequest()->getParam('id');
	if(!empty($_bannerId)){
		$this->_activeBanner=Mage::getModel('bannerextension/bannerextension')->load($_bannerId);
	}
	
  }
  
  //Get currenlty edit banner 
  public function getBanner(){
	return $this->_activeBanner;
  }
  
  //Get url of banner 
  public function getBanerUrl(){  	
	if($this->getBanner())
		return $this->getBanner()->getUrl();
	else
		return '';
  }
  //Get title of banner
  public function getBannerTitle(){
	if($this->getBanner())
		return $this->getBanner()->getTitle();
	else
		return '';
  }
  
  //Get status of banner
  public function getBannerStatus(){
	if($this->getBanner())
		return $this->getBanner()->getStatus();
	else
		return '';
  }
      
}