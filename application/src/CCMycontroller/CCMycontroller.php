<?php

class CCMycontroller extends CObject implements IController {

	
	private $guestbookModel;
	private $contentModel;
	private $imageModel;
	private $adminPanelModel;
	private $forumModel;
	private $userModel;
	
	
  public function __construct() { 
  parent::__construct(); 
  $this->guestbookModel = new CMGuestbook();
  $this->contentModel = new CMContent();
  $this->imageModel = new CMImages();
  $this->forumModel = new CMForum();
  $this->userModel = new CMUser();
  }
  

  public function index() {
    $content = new CMContent('about');
    $this->views->setTitle('Om Emil: '.htmlEnt($content['title']))
                ->addInclude(__DIR__ . '/page.tpl.php', array(
                  'content' => $content,
                  'news' =>  null,
                  'pic' => $this->imageModel->getOne(),
                  'size' => 'small',
                ),'primary' );
    $this->views->addInclude(__DIR__ . '/sidebar.tpl.php', array(
    	    'xml' => $this->xml,
    	    ), 'sidebar');
  
  }
  
  public function home()
  {
  	 $content = new CMContent('home'); 
  	 $this->views->setTitle('Home: '.htmlEnt($content['title']))
                     ->addInclude(__DIR__ . '/page.tpl.php', array(
                  'content' => $content,
                  'news' => $this->contentModel->getLatest(),
                  'pic' => null,
                ),'primary' );
         $this->views->addInclude(__DIR__ . '/sidebar.tpl.php', array(
    	    'xml' => $this->xml,
    	    ), 'sidebar');
                
  }
  
  public function me() {
    $content = new CMContent('mySelf');
    $this->views->setTitle('Om mig: '.htmlEnt($content['title']))
                ->addInclude(__DIR__ . '/page.tpl.php', array( 
                	'content' => $content,
                	'news' =>  null ,
                  	'pic' => null,
                	 ),'primary' );
    $this->views->addInclude(__DIR__ . '/sidebar.tpl.php', array(
    	    'xml' => $this->xml,
    	    ), 'sidebar');
  
  }
  
  /**
   * The blog.
   */
  public function news() {
  	  $this->views->setTitle('Nyheter: ')
                ->addInclude(__DIR__ . '/blog.tpl.php', array(
                  'contents' => $this->contentModel->listAll(array('type'=>'post', 'order-by'=>'title', 'order-order'=>'DESC')),
                  'formAction'=>$this->request->createUrl('', 'handler'),
                 ),'primary' );
    $this->views->addInclude(__DIR__ . '/sidebar.tpl.php', array(
    	    'xml' => $this->xml,
    	    ), 'sidebar');
 }
  
  
  public function pictures() {
    $this->views->setTitle('Bilder')
                ->addInclude(__DIR__ . '/pic.tpl.php', array(
                  'images' => $this->imageModel->readAll(),
                  'size' => 'big',
                 ),'primary' );
    $this->views->addInclude(__DIR__ . '/sidebar.tpl.php', array(
    	    'xml' => $this->xml,
    	    ), 'sidebar');
  }


  public function guestbook() {
  	$this->views->setTitle( "Guestbook" );
	$this->views->addInclude(__DIR__ . '/guestbook.tpl.php', array(
		'entries'=>$this->guestbookModel->readAll(), 
		'formAction'=>$this->request->createUrl('', 'handler')
    ),'primary' );
    $this->views->addInclude(__DIR__ . '/sidebar.tpl.php', array(
    	    'xml' => $this->xml,
    	    ), 'sidebar');
  }
  
   public function acp()
   {
  	$this->adminPanelModel = new CMAdminControlPanel();
  	$this->views->setTitle( "Administrative" );
	$this->views->addInclude(__DIR__ . '/acp.tpl.php', array(
		'entries'=> $this->adminPanelModel->readAll(), 
		'formAction'=>$this->request->createUrl('', 'handler')
    ));
   }
   public function remove()
   {
  	$this->adminPanelModel = new CMAdminControlPanel();
  	$this->views->setTitle( "Administrative" );
	$this->views->addInclude(__DIR__ . '/remove.tpl.php', array(
		'entries'=> $this->adminPanelModel->readAll(), 
		'formAction'=>$this->request->createUrl('', 'handler')
    ));
   }
    public function editNews()
   {
  	$this->views->setTitle( "Administrative" );
	$this->views->addInclude(__DIR__ . '/editIndex.tpl.php', array(
		'contents' => $this->contentModel->listAll(),
                ));
   }
    
    public function createPage() {
    $this->edit();
    }
    
    public function edit($id=null) {
    $content = new CMContent($id);
    $form = new CFormContent($content);
    $status = $form->check();
    if($status === false) {
      $this->addMessage('notice', 'The form could not be processed.');
      $this->redirectToController('edit', $id);
    } else if($status === true) {
      $this->redirectToController('edit', $content['id']);
    }
    
    $title = isset($id) ? 'Edit' : 'Create';
    $this->views->setTitle("$title content: $id")
                ->addInclude(__DIR__ . '/edit.tpl.php', array(
                  'user'=>$this->userModel, 
                  'content'=>$content, 
                  'form'=>$form,
		 ));
  }
   
   
   public function forum()
   {
  	$this->views->setTitle( "Forum" );
	$this->views->addInclude(__DIR__ . '/forum.tpl.php', array(
		'entries' => $this->forumModel->readAll(0),
		'formAction'=>$this->request->createUrl('', 'handler')
    ));
   }
   public function comment()
   {
   	
  	$this->views->setTitle( "Forum" );
  	$id  = $_SESSION['id'];
	$this->views->addInclude(__DIR__ . '/comment.tpl.php', array(
		'forum' => $this->forumModel->readAll( $id ),
		'entries' => $this->forumModel->readAllByStatus( $id ),
		'formAction'=>$this->request->createUrl('', 'handler')
    ));
   }
   
   public function commentNews()
   {
  	$this->views->setTitle( "Forum" );
  	$id  = $_SESSION['id'];
	$this->views->addInclude(__DIR__ . '/commentNews.tpl.php', array(
		'forum' => $this->contentModel->readAll( $id ),
		'entries' => $this->contentModel->readAllByStatus( $id ),
		'formAction'=>$this->request->createUrl('', 'handler')
    ));
   }
   
   public function editImage()
   {
   	$this->views->setTitle('Bilder');
   	$this->views->addInclude(__DIR__ . '/editImage.tpl.php', array(
		'formAction'=>$this->request->createUrl('', 'handler'),
                'images' => $this->imageModel->readAll(),
    ));
   }
   
   public function doAddImage($_FILES, $title, $photographer )
   {
   	  
   	if ((($_FILES["file"]["type"] == "image/gif")
   		|| ($_FILES["file"]["type"] == "image/jpeg")
   		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg"))
		&& ($_FILES["file"]["size"] < 7778350))
	{
		if ($_FILES["file"]["error"] > 0)
		{
			$this->addMessage('notice', "Return Code: " . $_FILES["file"]["error"] );
		}
		else
		{
			/*echo "Upload: " . $_FILES["file"]["name"] . "<br />";
			echo "Type: " . $_FILES["file"]["type"] . "<br />";
			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";*/
	
			if (file_exists("upload/" . $_FILES["file"]["name"]))
			{
				$this->addMessage('notice', $_FILES["file"]["name"] . " already exists. " );
			}
			else
			{
				$path = DRAWGIS_SITE_PATH . '/src/img';
				move_uploaded_file($_FILES["file"]["tmp_name"],
					"$path/" . $_FILES["file"]["name"]);
				$this->addMessage('success', "Stored in: " . "upload/" . $_FILES["file"]["name"]);
				$this->imageModel->add($_FILES["file"]["name"], $title, $photographer);
			}
		}
	}
	else
	{
		echo "Invalid file";
	}
	$this->redirectTo($this->request->createUrl($this->request->controller, 'editImage'));
	   
   }
   
    private function removeImg( $id )
    {
    	     $file = $this->imageModel->getNameFromId( $id );
    	     $path = DRAWGIS_SITE_PATH . '/src/img/';
    	     $files = $this->readDirectory($path);
    	     
    	     if(isset( $file ) && in_array( $file, $files))
    	     {
    	     	     $filename = $path . $file;
    	     	     unlink($filename);
    	     	     $files = $this->readDirectory($path);
    	     	     $res = "Filen raderades."; 
    	     	     $this->imageModel->remove( $id );
    	     }
    	     else
    	     {
    	     	     $res = "Filen finns ej och kunde inte raderas.";    
    	     }	
    	     $this->redirectTo($this->request->createUrl($this->request->controller, 'editImage'));
    }
  
    private function readDirectory($aPath) {
  $list = Array();
  if(is_dir($aPath)) {
    if ($dh = opendir($aPath)) {
      while (($file = readdir($dh)) !== false) {
        if(is_file("$aPath/$file") && $file != '.htaccess') {
          $list[$file] = "$file";
        }
      }
      closedir($dh);
    }
  }
  sort($list, SORT_STRING);
  return $list;
}
   
   
   /** 
   * Handler
   **/
   
  public function handler()  {
	if( isset($_POST['doAdd']) ) 
	{
	      $this->guestbookModel->add($_POST['newEntry'], $_POST['author'], $_POST['title']);
	      $this->redirectTo($this->request->createUrl($this->request->controller, 'guestbook'));
	}
	else if( isset($_POST['doCreate']) ) 
	{
	      $this->guestbookModel->init();
	      $this->redirectTo($this->request->createUrl($this->request->controllers));
	}
	else if( isset($_POST['doDel']) ) 
	{
	      $this->adminPanelModel->delete($_POST['email']);
	      $this->redirectTo($this->request->createUrl($this->request->controller, 'acp'));
	} 
	else if ( isset($_POST['doAddForum'] ) )
	{
	      $this->forumModel->addForum($_POST['message'], $_POST['author'] );
	      $this->redirectTo($this->request->createUrl($this->request->controller, 'forum'));	
	}
	else if ( isset($_POST['doAddComment'] ) )
	{
	      $this->forumModel->addComment($_POST['message'], $_POST['author'], $_POST['id'] );
	      $this->redirectTo($this->request->createUrl($this->request->controller, 'comment'));	
	}
	else if ( isset($_POST['doAddForumComment'] ) )
	{
	      $_SESSION['id'] = $_POST['id'];
	      $this->redirectTo($this->request->createUrl($this->request->controller, 'comment'));
	}
	else if ( isset($_POST['doDelForumComment'] ) )
	{
	      $this->forumModel->delete($_POST['id']);
	      $this->redirectTo($this->request->createUrl($this->request->controller, 'forum'));
	}
	else if ( isset($_POST['doAddNewsComment'] ) )
	{
	      $_SESSION['id'] = $_POST['id'];
	      $this->redirectTo($this->request->createUrl($this->request->controller, 'commentNews'));
	}
	else if ( isset($_POST['doAddNews'] ) )
	{
	      $this->contentModel->addComment($_POST['message'], $_POST['author'], $_POST['id'] );
	      $this->redirectTo($this->request->createUrl($this->request->controller, 'commentNews'));	
	}
	else if ( isset($_POST['doChangePassword'] ) )
	{
	       $this->doChangePassword($_POST['password'], $_POST['password1']);
	}
	else if ( isset($_POST['doProfileSave'] ) )
	{
	       $this->doProfileSave($_POST['name'], $_POST['email']);
	}
	else if ( isset($_POST['doUploadImg'] ) )
	{
	       $this->doAddImage( $_FILES, $_POST['title'], $_POST['photographer'] );
	}
	else if ( isset($_POST['doRemoveImage'] ) )
	{
		 $this->removeImg( $_POST['id']  );
	}
	else if ( isset($_POST['doDelGuestbook'] ) )
	{
		 $this->guestbookModel->deleteById( $_POST['id']  );
		 $this->redirectTo($this->request->createUrl($this->request->controller, 'guestbook'));	
	
	}
	
  }
	
   	
    
  
 
  
  /**
  * FROM CCUSER
  **/
  
  public function profile() {
		$form = new CFormUserProfile($this, $this->user);
		$form->check();

		$this->views->setTitle('User Profile');
                $this->views->addInclude(__DIR__ . '/profile.tpl.php', array(
                		'is_authenticated'=>$this->user['isAuthenticated'], 
                		'user'=>$this->user,
                		'formAction'=>$this->request->createUrl('', 'handler')
                ));
  }
  public function login() {
		$form = new CFormUserLogin($this);
		if($form->check() === false) {
			$this->addMessage('notice', 'Some fields did not validate and the form could not be processed.');
			$this->redirectToController('login');
		}
		 $this->views->setTitle('Login');
		  $this->views->addInclude(__DIR__ . '/login.tpl.php', array(
		 		'login_form' => $form,
		 		'allow_create_user' => CDrawgis::getInstance()->config['create_new_users'],
		 		'create_user_url' => $this->createUrl(null, 'create'),
                ));
        }
	
	public function doLogin($form) {
		if($this->user->login($form['acronym']['value'], $form['password']['value'])) {
			$this->addMessage('success', "Welcome {$this->user['name']}.");
			$this->redirectToController('profile');
		} else {
			$this->addMessage('notice', "Failed to login, user does not exist or password does not match.");
			$this->redirectToController('login');      
		}
	}
	
	public function logout() {
		$this->user->logout();
		$this->redirectToController();
	}
	public function doChangePassword($pwd1, $pwd2) {
		if(  $pwd1 != $pwd2 || empty( $pwd2 ) || empty($pwd1)  ) {
			$this->addMessage('error', 'Password does not match or is empty.');
		} else {
			$ret = $this->user->changePassword($pwd1);
			$this->addMessage($ret, 'Saved new password.', 'Failed updating password.');
		}
		$this->redirectToController('profile');
	}

	public function doProfileSave($name, $email) {
		$this->user['name'] = $name;
		$this->user['email'] = $email;
		$ret = $this->user->save();
		$this->addMessage($ret, 'Saved profile.', 'Failed saving profile.');
		$this->redirectToController('profile');
	}
	
	
	public function create() {
		$form = new CFormUserCreate($this);
		if($form->check() === false) {
			$this->addMessage('notice', 'You must fill in all values.');
			$this->redirectToController('Create');
		}
		$this->views->setTitle('Create user');
		$this->views->addInclude(__DIR__ . '/create.tpl.php', array('form' => $form->getHTML()));     
	}
	
	
	public function doCreate($form) {    
		if($form['password']['value'] != $form['password1']['value'] || empty($form['password']['value']) || empty($form['password1']['value'])) {
			$this->addMessage('error', 'Password does not match or is empty.');
			$this->redirectToController('create');
		} else if( $this->user->create( $form['acronym']['value'], 
			   			$form['password']['value'],
			   			$form['name']['value'],
			   			$form['email']['value']
                           )) {
                $this->addMessage('success', "Welcome {$this->user['name']}. Your have successfully created a new account.");
                $this->user->login($form['acronym']['value'], $form['password']['value']);
                $this->redirectToController('profile');
                	   } else {
                	   	   $this->addMessage('notice', "Failed to create an account.");
                	   	   $this->redirectToController('create');
                	   }
        }
  
        /** 
        * Slut på CCUser
        **/
 
  
}


