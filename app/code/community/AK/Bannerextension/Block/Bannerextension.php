<?php
/**
 *    AK Bannerextension main block
 *    @author AK
 */
 
class AK_Bannerextension_Block_Bannerextension extends Mage_Core_Block_Template {
	
	private $_configData='';
	protected $test=0;
	
	public function _construct(){
		parent::_construct();
		// get banner admin setting info		
		$this->_configData=Mage::getStoreConfig('ak_bannerextension/general');
	}
	
	//load all of the enabled items from database table 'bannerextension'.
	public function getBannerCollection() {
		$_bannercollection = Mage::getModel('bannerextension/bannerextension')->getCollection()
			->addFieldToFilter('status',1);
		return $_bannercollection;
	}
	
	public function getConfigData() {
		return $this->_configData;
	}
	
	// Extension is enabled in admin or not
	public function getIsEnabled(){
		$_configData=$this->getConfigData();
		$_isEnabled = $_configData['enabled'];		
		return $_isEnabled;
	}
	
	// Get banner dimension
	public function getBannerSize(){
		$_configData=$this->getConfigData();
		if (strstr($_configData['bannerSize'], '_')) {
			$_bannerSize = explode('_', $_configData['bannerSize'], 2);
		} else {
			$_bannerSize = array(500,500);
		}
			
		return $_bannerSize;
	}	
	
	// start banner sliding automatically or not.
	public function showAuto(){
		$_configData=$this->getConfigData();
		$_bannerAuto = $_configData['bannerAuto'];		
		if($_bannerAuto)
			return $_bannerAuto;
		else
			return 0;
	}
	
	// start banner sliding speed.
	public function getSlideSpeed(){
		$_configData=$this->getConfigData();
		$_bannerSpeed = $_configData['bannerSpeed'];		
		if($_bannerSpeed)
			return $_bannerSpeed;
		else
			return 600;
	}			
	
	// Find how many banner need to show per slide
	public function showVisible(){
		$_configData=$this->getConfigData();
		$_bannerVisible = $_configData['bannerVisible'];		
		if($_bannerVisible)
			return $_bannerVisible;
		else
			return 1;	
	}
	
	// Show next and prev slide link
	public function showNavigation(){
		$_configData=$this->getConfigData();
		$_bannerNavigation = $_configData['bannerNavigation'];		
		return $_bannerNavigation;
	}
	
	// Show banner pagination or not	
	public function showPagination(){
		$_configData=$this->getConfigData();
		$_bannerPagination = $_configData['bannerPagination'];
		return !$_bannerPagination;	
	}		
	
/*	// Show sliding vertically or not
	public function getBannerEffects(){
		$_configData=$this->getConfigData();
		$_bannerVertically = $_configData['bannerVertically'];
		return $_bannerVertically;		
	}	

	// Show Fade effect or not
	public function showFadeEffect(){
		$_configData=$this->getConfigData();
		$_bannerFadeEffect = $_configData['bannerFadeEffect'];		
		return $_bannerFadeEffect;	
	}*/
	
	// get banner sliding effect
	public function getBannerEffects(){
		$_configData=$this->getConfigData();
		$_bannerEffects = $_configData['bannerSlideEffect'];
		return $_bannerEffects;		
	}	
	
	// Banner image complete path			
	public function getImagePath($_filename){
		return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).$_filename;
	}
		
}