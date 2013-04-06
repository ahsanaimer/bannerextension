<?php
/**
 *    AK Bannerextension admin controller file
 *    @author AK
 */
 
 
class AK_Bannerextension_Adminhtml_BannerextensionController extends Mage_Adminhtml_Controller_Action
{

	//Index action for manage banner link.
	public function indexAction() {
		$this->_title($this->__('Bannerextension'))
			->_title($this->__('Manage banner'));
		$this->loadLayout();
		$this->_setActiveMenu('bannerextension/managebanners');
		$this->renderLayout();
	}

	//Edit action for edit banner link.
	public function editAction() {
		$this->loadLayout(); 
		$this->renderLayout();
	}
    
	//Add new banner action.
	public function newAction() {
		$this->loadLayout();
		$this->_setActiveMenu('bannerextension/addbanner');
		$this->renderLayout();
	}
    
	
	//Save new banner action.
	public function saveAction() {
	
		$_bannerData = $this->getRequest()->getPost(); // Getting post data	
		$_bannerId=$this->getRequest()->getParam('id');	
		if(!empty($_bannerData)){
			//File Uploading Code
			if(isset($_FILES['filepath']['name']) && $_FILES['filepath']['name'] != '') {
			
				try {					
					$_fileUploader = new Varien_File_Uploader('filepath');			
					$_fileUploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));//acceptable file format
					$_fileUploader->setAllowRenameFiles(false);
					$_fileUploader->setFilesDispersion(false);				
					$_filepath = Mage::getBaseDir('media') . DS ; //Banner folder path /media//i/file.jpg
					$_result = $_fileUploader->save($_filepath, $_FILES['filepath']['name'] );
					$_bannerData['filepath'] = $_result['file'];
				} catch (Exception $e) {
					$_bannerData['filepath'] = $_FILES['filepath']['name'];
				}
			}
			//End File Uploading Code	
						
			$_banner = Mage::getModel('bannerextension/bannerextension');
			//Setting the banner values		
			$_banner->setData($_bannerData); 
			
			if($_bannerId)
			//Setting the id if banner is in edit mode
			$_banner->setId($_bannerId); 
			
			try {
				//save the banner				
				$_banner->save();
				//add success msg for admin
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('bannerextension')->__('Banner was successfully saved'));
            } catch (Exception $e) {
                // add error msg for admin user
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // clear form data
				Mage::getSingleton('adminhtml/session')->setFormData($data);
                return;
            }
			
			$this->_redirect('*/*/');
			return;						
		}	

	}
	
	//Delete specific or all banners action.
    public function deleteAllAction() {
        $_bannerIds = $this->getRequest()->getParam('bannerextension');		
		
		//If no item is selected by user.
        if(!is_array($_bannerIds)) { 
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($_bannerIds as $_id) {
					// load banner data
                    $_banner = Mage::getModel('bannerextension/bannerextension')->load($_id); 
                    // delete the banner
					$_banner->delete(); 
                }
				//add success msg for admin
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($_bannerIds)
                    )
                );
            } catch (Exception $e) {
				// add error msg for admin user
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }	


}