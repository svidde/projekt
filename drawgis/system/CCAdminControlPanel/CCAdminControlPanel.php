<?php


/**
* Admin Control Panel to manage admin stuff.
* 
* @package LydiaCore
*/

class CCAdminControlPanel extends CObject implements IController {

	private $adminPanelModel;

  public function __construct() {
  	parent::__construct();
	$this->adminPanelModel = new CMAdminControlPanel();
  }


  public function index() {
  	$this->views->setTitle( "Administrative" );
	$this->views->addInclude(__DIR__ . '/index.tpl.php', array(
		'entries'=> $this->adminPanelModel->readAll(), 
		'formAction'=>$this->request->createUrl('', 'handler')
    ));
  }
  
  public function handler()  {
	if( isset($_POST['doDel']) ) 
	{
	      $this->adminPanelModel->delete($_POST['email']);
	} 
     $this->redirectTo($this->request->createUrl($this->request->controller));
  }
  
  
} 
