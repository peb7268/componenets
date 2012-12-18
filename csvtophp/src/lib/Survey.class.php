<?php
/**
 *	Refactoring to be done.
 * 	#need to define a folder / file naming schema and use it to: 
 * 
 * 	1) Call an init method which sets up project
 * 	2) Generate handles dynamically	 
 * 	3) Define a system of method calls that build each survey
 * 	4) Define a method call that calls step 3 for each survey
 * 	5) Ensure mapping to JSON works correctly
 * 
 * 	Flow:	
 * 	1) __construct / Init
 * 	2) getSurveyNames -> assembleSurveyData(assembleSurveyReport, mapRows)
 * 	3) 
 * 
 */
class Survey {
	public $config;
	public $handles;
	public $info;
	public $result;


	function __construct($config){
		$this->config = $config;
		$this->result = $this->init($config);
		return json_encode($this->result);
	}
	function init($config){
		$this->info = 	$this->getSurveyNames($config->dir);
					   	$this->getHandles();
		$result 	=	$this->assembleSurveyData();
		$json 		=	$this->buildCharts($result);
		return json_encode($json);
	}
	function encode($mixed){
		return json_encode($mixed);
	}
	function getHandles(){
		$handles = [];
		foreach($this->info['file_names'] as $filename){
			$handles[$filename][] = fopen('./assets/consortium_level_2012/CSV/'.$filename, "r");
		}
		$this->handles = $handles;
	}
	function cleanForShortURL($toClean) {
		    $toClean     =    str_replace('&', '-and-', $toClean);
		    $toClean     =    trim(preg_replace('/[^\w\d_ -]/si', '', $toClean));//remove all illegal 
		    return strtr($toClean, $GLOBALS['normalizeChars']);
	}
	function clean($string){
		//echo 'string is '.$string.'<br>';
		$remove = array("ÿ", "þ");
		$sanitized = strip_tags($string);

		$sanitized = $this->cleanForShortURL($sanitized);

		return $sanitized;
	}
	function debug($message = null, $arr = array(), $showArrayKeys = false){
		echo "<pre>".$message.'<br>';
		if($showArrayKeys){
			echo "Has ".count(array_keys($arr))." keys";
			echo $this->debug("Type: $arr", implode(', ', array_keys($arr)));
			echo "-----------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";
			echo "Contains: <br>-----------------------------------------------------------------------------------------------------------------------------------------------------------------------<br><br>";
		}
			var_dump($arr);
		echo "</pre>";
	}
	function getSurveyNames($dir_path){
		$names 		= array();
		$filenames 	= [];
		$files 		= scandir($dir_path);
		
		foreach($files as $file){ 
			$pattern 	= '/^[^.][\p{L} .].+$/';
			$bool 		= preg_match_all($pattern, $file);

			if($bool){
				$filenames[] = $file;
				$file = explode(".", $file)[0];
				$names[] 	= str_replace('_', ' ', $file);
			}
		}
		$info = array('survey_names' => $names, 'file_names' => $filenames);
		return $info; 
	}
	function printCsvHeaders($value, $key, &$rows){
		if($value != ""){
	    	$rows[$key][] = $this->clean($value);
	    }
	}
	function printCsvRows($currow, $value, $key, &$rows){
		$rows[$key][$currow][] = $this->clean($value);
	}
	function getRows($handle){
		$rowI = 0;
		$rows = array();

		if ($handle !== FALSE) {
		    while (($responses = fgetcsv($handle, 0, ",")) !== FALSE) {
		        $num = count($responses);
		        for ($count = 0; $count < $num; $count++) {
		            if($rowI == 0){
		            	$this->printCsvHeaders($responses[$count], "question_title", $rows);
		            } else {
		            	$this->printCsvRows($rowI, $responses[$count], "responses", $rows);
		            }
		        }
		        $rowI++;
		    }
		    fclose($handle);
		    return $rows;
		} else {
			echo 'Couldnt get a file handle';
		}
	}
	//Accepts an $array and a key $map. $map must be in order of $array
	function remapKeys($array, $map){
		$keys 	= array_keys($array);
		$count 	= count($keys); 
		$tmp 	= [];

		for($i = 0; $i < $count; $i++){
			if(gettype($keys[$i]) == 'integer'){ 
				$tmp[$map[$i]] = $array[$i];
			} else {
				$tmp[$map[$i]] = $array[$map[$i]];
			}
		}
		//$this->debug('Remapped array is: ', $tmp);
		return $tmp;}
	//Assembles each care.survey: properties objects. An instance of what each report contains.
	function assembleReport($handle, $surveyName){
		$map = array('survey_name', 'responses', 'question_title');

		$rows = $this->getRows($handle);
		array_unshift($rows, $surveyName);
		$rows = $this->remapKeys($rows, $map);
		
		//$json = json_encode($rows, JSON_UNESCAPED_UNICODE);
		return $rows;
	}
	//Build the master object for each question
	function assembleSurveyData(){
		$map = array('info', 'data', 'user');
		
		$master = [];
		$master['info'] = $this->info;	
		$master['data'] = [];

		//Builds the surveys section of each object and pops them onto the data element of the $master array
		for($i = 0; $i < count($this->handles); $i++){
			foreach($this->handles[$this->info['file_names'][$i]] as $handle){
				$master['data'][$i]['name'] 	=	$this->info['file_names'][$i];
				$master['data'][$i]['report'] 	=	$this->assembleReport($handle, $this->info['file_names'][$i]);
			}
		} 

		$master['user'] = $this->config->User;
		return $master;
	}
	function buildCharts($result){
		
		//echo '<pre>'; var_dump($result); echo '</pre>';

		$data  = $result;
		return $data;} 
}