<?php

class CMImages extends CObject implements IHasSQL, IModule  {

	
	
	public function __construct() {
		parent::__construct();
	}
  
	
	public static function SQL($key=null) {
		$queries = array(
		'create table images'  => "CREATE TABLE IF NOT EXISTS images (id INTEGER PRIMARY KEY, filename TEXT, title TEXT, photographer TEXT );",
		'insert into images'   => 'INSERT INTO images (filename,title,photographer) VALUES (?,?,?);',
		'select * from images' => 'SELECT * FROM images ORDER BY id DESC;',
		'drop tabel images' => 'DROP TABLE IF EXISTS images;',
		);
		if(!isset($queries[$key])) {
			throw new Exception("No such SQL query, key '$key' was not found.");
		}
		return $queries[$key];
	}
  
	
  public function manage($action=null) {
  	  $filenamestart =  "EmilJensen_";
  	  $filenameend = ".jpg";
  	  $JohanDahlroth = "JohanDahlroth";
  	  $PeterWestrup = "PeterWestrup";
  	  
    switch($action) {
      case 'install': 
        try {
          $this->db->executeQuery( self::SQL('drop tabel images') );	
          $this->db->executeQuery( self::SQL('create table images') );
         for ( $i = 1 ; $i < 4 ; $i++ )
         {
          $photographer = $JohanDahlroth;
          $filename = "$filenamestart"."$i"."_".$photographer."$filenameend";
          $title = 'Emil Jensen';
          $this->db->executeQuery(self::SQL('insert into images'), array( $filename, $title, $photographer ) );
         }
         for ( $i = 1 ; $i < 3 ; $i++ )
         {
          $photographer = $PeterWestrup;
          $filename = "$filenamestart"."$i"."_".$photographer."$filenameend";
          $title = 'Emil Jensen';
          $this->db->executeQuery(self::SQL('insert into images'), array( $filename, $title, $photographer ) ); 
         }
          return array('success', 'Successfully created the database tables (or left them untouched if they already existed).');
        } catch(Exception$e) {
          die("$e<br/>Failed to open database: " . $this->config['database'][0]['dsn']);
        }
      break;
      
      default:
        throw new Exception('Unsupported action for this module.');
      break;
    }
  }
  
  private function createImgUrl( $urlOrController )
  {  
  	$method = null;
  	$arguments=null;
  	return CDrawgis::getInstance()->request->createUrl( $urlOrController, $method, $arguments);
  }
  
  public function init() 
  {
  	  try 
	  {
		$this->db->executeQuery(self::SQL('create table guestbook'));
		#$this->session->addMessage('notice', 'Successfully created the database tables (or left them untouched if they already existed).');
	  } 
	  catch( Exception $e ) 
	  {
		die("$e<br/>Failed to open database: " . $this->config['database'][0]['dsn']);
	  }
  }

  public function add($entry, $author=null, $title=null) 
  {
  	  if ( $entry == "" OR $author == "" OR $title == "" )
  	  {
		  
	  }
	  else
	  {
	  	 if ( $author == null && $title == null )
		  {
			  $this->db->executeQuery(self::SQL('insert into sguestbook'), array($entry));
			  #$this->session->addMessage('success', 'Successfully inserted new message.');
			
			  if($this->db->rowCount() != 1) 
			  {
				die('Failed to insert new guestbook item into database.');
			  }  
		  }
		  else
		  {
			$this->db->executeQuery(self::SQL('insert into guestbook'), array($entry, $author, $title));
			  #$this->session->addMessage('success', 'Successfully inserted new message.');
			
			  if($this->db->rowCount() != 1) 
			  {
				die('Failed to insert new guestbook item into database.');
			  }    
		  } 
	  }
  }

  
  
  public function readAll() 
  {
  	 try
	 {
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $this->db->executeSelectQueryAndFetchAll(self::SQL('select * from images'));
	 } 
	 catch(Exception $e) 
	 {
		return array();
	 } 
  }
  
}
