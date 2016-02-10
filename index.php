<?php
/* LIST OF FUNCTIONS 
  1.GETNAME   - for get all available tags in page 
  2.HTML    - for fetching each node
  4.STRATSWITH - for checking starting words 
  5.ENSWITH    - for checking ending words 
  6.TITLE      - for geting title and h1 and other tags 
  7.VALIDATEURL- for valinding urls for missing words 
  8.DOMAIN     - get the current url main domain name or host name
  9.MAKEARRAY  - for making array with unique values 
 10.CALLORPERFECTION   
   for setting database and count down the all urls
 11.NEWTABLE   - for making 1st time calling urls create table
 12.INSERT     - for  insering data in database


*/

require_once("wenbot.php");
require_once("DB.php");
$timeswen=new DB("localhost","root","","bigdata");
$sql=<<<EOSQL
CREATE TABLE IF NOT EXISTS url (wen_no   bigint(20) AUTO_INCREMENT
,wen_hash   varchar(128) UNIQUE
,wen_ref    text
,wen_level  int(10)
,wen_name   text
,wen_time   int(10)
,wen_type   text
,wen_secure TINYINT(1)
,wen_safe   TINYINT(1)
,wen_mobile TINYINT(1)
,wen_length bigint(20)
,wen_link   int(10)
,wen_rank   int(10),
PRIMARY KEY(wen_no));
EOSQL;

$timeswen->fire($sql);

/*foreach ($q as $data ) 
{
	echo $data['wen_no']."\t";
	echo $data['wen_name']."\t";
	echo $data['wen_hash']."\n";
}*/
$wen=new bot("https://www.youtube.com/watch?v=SZq9z364dkQ");
echo $wen->DOMAIN();
echo $wen->finalurl;
$wen->GETNAME($wen->html);
$uarray=$wen->MAKEARRAY($wen->tags);
$wen->HTML($uarray);
print_r($wen->node);
?>