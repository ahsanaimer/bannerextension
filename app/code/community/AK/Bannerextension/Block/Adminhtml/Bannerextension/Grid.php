<?php

/**
 *    AK Bannerextension main grid block
 *    @author AK
 */
 
class AK_Bannerextension_Block_Adminhtml_Bannerextension_Grid extends Mage_Adminhtml_Block_Widget_Grid{

  public function __construct(){
      parent::__construct();
      $this->setId('bannerextensionGrid');
      $this->setSaveParametersInSession(true);
	  $this->setTemplate('bannerextension/grid.phtml'); //Custom template to show thumbnail in grid
  }
	
  //Load all data from table for grid	
  protected function _prepareCollection(){
      $collection = Mage::getModel('bannerextension/bannerextension')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }
  
  //Add specific columns for grid
  protected function _prepareColumns()
  {
      $this->addColumn('id', array(
          'header'	=> Mage::helper('bannerextension')->__('ID'),
          'align'	=>'right',
          'width'	=> '50px',
          'index'	=> 'id',
      ));

      $this->addColumn('filepath', array(
          'header'	=> Mage::helper('bannerextension')->__('Thumbnail'),
          'type'	=>'image',
		  'align'	=>'left',
		  'width'	=> '50px',
          'index'	=> 'filepath',
		  'filter'	=> false,		  
      ));

      $this->addColumn('url', array(
          'header'	=> Mage::helper('bannerextension')->__('Url'),
          'align'	=>'left',
          'index'	=> 'url',
      ));
	  	  
      $this->addColumn('title', array(
          'header'	=> Mage::helper('bannerextension')->__('Title'),
          'align'	=>'left',
          'index'	=> 'title',
      ));	  

      $this->addColumn('status', array(
          'header'	=> Mage::helper('bannerextension')->__('Status'),
          'align'	=> 'left',
          'width'	=> '80px',
          'index'	=> 'status',
          'type'	=> 'options',
          'options'	=> Mage::helper('bannerextension')->getStatusFields(),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('bannerextension')->__('Action'),
                'width'     => '100px',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('bannerextension')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
	  
      return parent::_prepareColumns();
  }

	//Add mass feature.Allow admin to delete multiple items.
    protected function _prepareMassaction(){
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('bannerextension');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('bannerextension')->__('Delete'),
             'url'      => $this->getUrl('*/*/deleteAll'),
             'confirm'  => Mage::helper('bannerextension')->__('Are you sure?')
        ));       
        return $this;
    }

  //Add row url.Allow admin to open specific item.	
  public function getRowUrl($row){
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }
  

}