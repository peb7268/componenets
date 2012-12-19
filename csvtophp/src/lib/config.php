<?php 
$GLOBALS['normalizeChars'] = array(
    'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 
    'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 
    'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 
    'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 
    'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 
    'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 
    'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f'
);
require_once('Survey.php');
// $handle = fopen("test.csv", "r");
//$handle = fopen("./assets/consortium_level_2012/CSV/Sheet_1.csv", "r");

//File Configs
//$base  			= getcwd().'/assets/';		//dev
$base				= './files/assets/';		//cake
$sub_dir 		= 'consortium_level_2012/';
$type			= 'CSV/';
$dir 			= $base.$sub_dir.$type;

$config = new StdClass();
$config->dir 	= $dir;

//User Object
$config->User 				= new StdClass();
$config->User->id 			= '1';
$config->User->role_id		= '1';
$config->User->username		= 'peb7268';
$config->User->active		= true;
$config->User->meta_id		= null;
$config->User->date_added	= '2012-11-15 19:28:00';
$config->User->token		= 't4g7d5g3a8b10f0n0p5z2w2h9h10g4n5a6b8g6a7d3';
$config->User->Role			= array('id' => '1', 'role' => 'root');
