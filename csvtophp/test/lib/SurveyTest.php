<?php 
$base = "/Applications/XAMPP/xamppfiles/htdocs/infosurv/components/csvtophp";
require_once($base.'/src/lib/Survey.php');

class SurveyTest extends PHPUnit_Framework_TestCase {
	
	protected $survey;
	protected $config;
	
	public function setup(){
		$GLOBALS['normalizeChars'] = array(
		'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 
		'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 
		'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 
		'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 
		'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 
		'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 
		'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f'
		);

		//File Configs
		//$base			= getcwd().'/assets/';
		$xampp			= '/Applications/XAMPP/xamppfiles/htdocs/';
		$path			= 'infosurv/components/csvtophp/';
		$base           = 'src/assets/'; 
		$sub_dir		= 'consortium_level_2012/';
		$type			= 'CSV/';
		$dir			= $xampp.$path.$base.$sub_dir.$type;
		
		$config = new StdClass();
		$config->dir	= $dir;

		//User Object
		$config->User				= new StdClass();
		$config->User->id			= '1';
		$config->User->role_id		= '1';
		$config->User->username		= 'peb7268';
		$config->User->active		= true;
		$config->User->meta_id		= null;
		$config->User->date_added	= '2012-11-15 19:28:00';
		$config->User->token		= 't4g7d5g3a8b10f0n0p5z2w2h9h10g4n5a6b8g6a7d3';
		$config->User->Role			= array('id' => '1', 'role' => 'root');
		$this->config = $config;

		$survey = new Survey($config);
		$this->survey = $survey;
	}

	//Test That the test is on .. :)
	public function testMain(){
		$this->assertEquals(1, 1);
	}
	//Start the real tests
	public function test__construct(){
		$this->assertClassHasAttribute('config', 'Survey');
		//$this->survey->result = null;
		$this->assertNotNull($this->survey->result, "\$survey->result is null");
	}
	public function testSurveyProperties(){	
		$this->assertEquals($this->survey->config->User->username, 'peb7268', "username is set");
		//$this->survey->config->dir = null;
		$this->assertNotNull($this->survey->config->dir, "There is no config->dir set");
	}
	public function testInit(){
		$this->assertNotNull($this->survey->init($this->survey->config), "Init is not returning a json string");	
		$this->assertInternalType('string', $this->survey->init($this->survey->config), 'init is not returning a string');
		$this->assertInternalType('array',$this->survey->info, "Survey names have not been pulled");

		//want to refactor this to actually test resources but not working
		foreach($this->survey->handles as $handle){	
			$this->assertInternalType('array', $handle, "Resource handle not set");
		}
	}

	//......More tests here internally, mocks and stubbs ect..

	//New stuff
	public function testBuildCharts(){	
		//Create a fake mock object - that fakes what we will pass to buildCharts
		$mock	=	$this->getMock('Survey', array('assembleSurveyData'), array($this->config));
		$assembled_result =	array(
						"info" => array("survey_names" => [], "file_names" => []),
						"data" => array(array(1,2,3), array(4,5,6)),
						"user" => array()
					);
		
		//Config the mock
		$mock->expects($this->any())								//Mock expects this method can be called any number of times
		->method('assembleSurveyData')								//Name of method to fake
		->will($this->returnValue($assembled_result));			    //what the mock will return

		$return = $mock->assembleSurveyData();						//Call the faked out method
		
		//Evaluate the real target of this test						//Forcing return values and manually calling methods like this
		$result = $mock->buildCharts($return);						//Allow us to force normal and abnormal logic cases for the																	           //method under test, in this case that would be buildCharts.

		$this->assertInternalType('array', $result, "The result of Survey::buildCharts is not an array");
	}
	


	
	//End tests & cleanup
	public function teardown(){	unset($this->survey); $this->survey = null;	}
	//
}
