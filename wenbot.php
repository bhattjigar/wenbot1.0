<?php 
require_once("DB.php");

class bot
{
	static $count=0;
	static $table;
	
	static $maindomain;
	function __construct($url)
	{
		try
		{
			$this->url=$url;
			
			if (!function_exists('curl_init'))
        	{
              	  die('Timeswen is Busy....');
        	}
        	else
        	{
        		$ch = curl_init();

                  $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
                  $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
                  $header[] = "Cache-Control: max-age=0";
                  $header[] = "Connection: keep-alive";
                  $header[] = "Keep-Alive: 300";
                  $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
                  $header[] = "Accept-Language: en-us,en;q=0.5";
                  $header[] = "Pragma: ";

                  curl_setopt($ch, CURLOPT_URL, $url);
                  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36");
                  //curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Wenbot/1.0; +http://www.Timeswen.com/wenbot");
                  curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

                    
                    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36");
                    //curl_setopt($ch, CURLOPT_POST, TRUE);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                    $this->html=curl_exec($ch);

                    $report=curl_getinfo($ch);
                    curl_close($curl);
                      /*echo $url."</br>".$report['http_code']."</br>";*/
                      
					          if($report['http_code']==404 || strpos($report['content_type'], 'text') === FALSE)
                    {
                      $del=new DB("localhost","root","","bigdata");

                      $table=bot::$table;
                      $tmp=hash('sha512',$url);

                      $sql=<<<EOSQL
                      DELETE FROM $table WHERE wen_hash='$tmp';
EOSQL;
                      $del->fire($sql);
                      $del=null;
                    }
                      $this->DOMAIN($url);
                      $this->GETNAME($this->html);
					        
                    
        		  
			      	
				    
				  
				  

        	}
		}
		catch(Exception $e)
		{
			echo $e->getMesage();
		}
          
      
	}
	public function DESTROY($r)
	{
		unset($r);
	}


	public function GETNAME($html)
	{
		try
		{
				$this->dom=new DOMDocument();
			    $this->dom->loadHTML($html);

			    foreach($this->dom->getElementsByTagName('*') as $e )
			        {
						$this->tags[$e->nodeName]='';
			        }
			        $this->HTML($this->MAKEARRAY($this->tags));
		}
	    catch(Exception $e)
	    {
	    	echo $e->getMesage();
	    }		  

	}

	public function MAKEARRAY($array)
    {
    	try
    	{
    		$tmp=array();
            foreach ($array as $key => $value)
            	{
                 
                 array_push($tmp,$key);        

             	}
      
      		return $tmp;
    	}
        catch(Exception $e)
        {
        	echo $e->getMesage();
        }   


    }
    public function DOMAIN($url)
    {
    	try
    	{
    		

    		$this->urltype=substr($url,0,5);

	      	if($this->urltype=="https")
	      		{
	        		$this->urltype=substr($url,0,6);
	      		}
	      	$pieces = parse_url($url);
	        $domain = isset($pieces['host']) ? $pieces['host'] : '';
	        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
		         {
		        	$this->finalurl=$this->urltype."//".$regs['domain'];
		          	$this->domain=$regs['domain'];
		         }
	        return false;
    	}
    	catch(Exception $e)
    	{
    		echo $e->getMesage();
    	}
    	
	    
    }

    public function HTML($tmp)
    {
    	try
    	{
    		if(bot::$count==0)
      		{ 
        		bot::$count=1;
        		bot::$table=str_replace(".","_",$this->domain);
        		bot::$maindomain=$this->domain;
        		$this->NEWTABLE();
    		}

    		foreach ($tmp as $tag) 
    		{

    			foreach($this->dom->getElementsByTagName($tag) as $node )
		        {
		        	foreach ($node->attributes as $attrName => $attrNode)
		        	 {

		        		$this->node[trim($node->nodeName)][trim($attrName)][trim($attrNode->nodeValue)]="";
		        		if($attrName=='href'||$attrName=='src')
                    	{
                    		$this->VERIFYURL($attrNode->nodeValue);

                    	}

		        	 }
		          
		        }	
    		}
    		$this->ENTRY();
    		
    	}
    	catch(Exception $e)
    	{
    		echo $e->getMesage();
    	}
		 
    }
    public function NEWTABLE()
      {

                $Timeswen=new DB("localhost","root","","bigdata");
                
                // why use this beacuase in EOSQL statement 
                // it error like undefined databse or syntax 

                $table=bot::$table;


                $sql=<<<EOSQL
				CREATE TABLE IF NOT EXISTS $table (wen_no   bigint(20) AUTO_INCREMENT
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
				wen_iscrawl int(1) NOT NULL DEFAULT 0,
				PRIMARY KEY(wen_no));
EOSQL;
                $Timeswen->fire($sql);

                $tmp=hash('sha512',$this->url);
                $sql=<<<EOSQL
                INSERT IGNORE INTO  $table(wen_name,wen_hash) VALUES('$this->url','$tmp');
EOSQL;
				$Timeswen->fire($sql);

                $tmp=hash('sha512',$this->finalurl);
                $sql=<<<EOSQL
                INSERT IGNORE INTO  $table(wen_name,wen_hash) VALUES('$this->finalurl','$tmp');
EOSQL;
                $Timeswen->fire($sql);


                $Timeswen= null;

                
      }
      public function START($haystack, $needle) 
     {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
     }



      public function END($haystack, $needle) 
      {
          // search forward starting from end minus needle length characters
          return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
      }
      public function CHECKNULL($str)
     {
     	if(trim($str)!=="")
     	{
     		return 1;
     	}
     	else
     	{
     		return 0;
     	}

     }
     public function ISWORD($string,$ch)
      {
      	if(substr($string,$ch)!== false)
      	{
      		return 1;
      	}
      	else
      	{
      		return 0;
      	}
      }
      ///validating url for [//] [/] [starts with www ] [verified with url http or https:]
     /*
     0.  .
     1. //
     2. /
     2.1  ./    
     3. http:
     4. https:
     5. www

     */
    public function VERIFYURL($url)
    {
                
                $oldurl=$url;

                $url=str_replace("\\","",$url);

                $url=str_replace('"',"",$url);
                
                
		        if($this->START($url,"//")==1)
		        {
		            $url=$this->urltype.$url;
		            //echo "</br>//------>".$url."</br>";
		        }

		        else if($this->START($url,"/")==1)
		        {
		            
		            $url=$this->urltype."//".$this->domain.$url;
		            //echo "</br>/------>".$url."</br>";
		        }


		        else if($this->START($url,"./")==1)
		        {
		        	
		            $url=str_replace("./","",$url);
		            $url=$this->urltype."//".$this->domain."/".$url;
		            //echo "</br>./------>".$url."</br>";
		        }


		        else if($this->START($url,".")==1)
		        {
		             $url=$this->url;
		             //echo "</br>...------>".$url."</br>";
		        }

		        else if($this->START($url,"www")==1)
		        {
		                 
		              $url=$this->urltype."://".$url;
		              //echo "</br>www------>".$url."</br>";

		        }
		        else if($this->START($url,"#")==1)
		        {
		           $url=$this->url;
		        }
		        
		 
		        else
		        {
		        	
		              
		            //$url=$this->url.$url;
		        }

              

		       

	            if($this->END($url, '.jpg') ==1||$this->END($url, '.png') ==1||$this->END($url, '.js') ==1||$this->END($url, '.css') ==1||$this->END($url, 'javascript:void') ==1||$this->END($url, '.gif') ==1||$this->END($url, '.ico') ==1)
	              {
	                $this->xa[$oldurl]="";    
	              }
	            else
	            {
	            	if($this->CHECKNULL($url)==1&&$this->START($url,"http")==1)
	            	{
	            		$this->a[$url]="";	
	            	}
	            	else
	            	{
	            		$url=trim($url);
	            		if($url!="")
	            		{
	            			/*echo "::".$url."::</br>";*/
		            		$url=$url=$this->url."/".$url;
		            		$this->a[$url]="";
		            		
		            		/*echo "[".$url."]</br>";	*/
	            		}
	            		
	            	}
	            	

	            }
	              


    }
      public function ENTRY()
      {
      			$Timeswen=new DB("localhost","root","","bigdata");
      			$t=$this->MAKEARRAY($this->a);
      			
      			
      			
      			foreach ($t as $url)
      			 {
      			 	$this->domain($url);
      			 	if(bot::$maindomain==$this->domain)
	      			{
	      				$table=bot::$table;
	      					
	      			}
	      			else
	      			{
	      				$table="url";
	      			}
	      			//echo "</br>".bot::$maindomain."--->".$this->domain;
	      			//echo "[".$url."]</br>";
      				$tmp=hash('sha512',$url);
	      			$sql=<<<EOSQL
	      			INSERT IGNORE INTO $table(wen_name,wen_hash) VALUES('$url','$tmp');
EOSQL;
					$Timeswen->fire($sql);

      			}
      			$table=bot::$table;
      			$url=$this->url;

      			$sql=<<<EOSQL
      			UPDATE  $table 
      			SET wen_iscrawl=1 
      			WHERE wen_name='$url';
EOSQL;

				$Timeswen->fire($sql);

				$sql=<<<EOSQL
				SELECT wen_name from $table WHERE wen_iscrawl=0 LIMIT 1;
EOSQL;
      			$link=$Timeswen->select($sql);

      			//AT THAT TIME TO FLUSH MEMORY AND GO TO INFINITE 
      			
      			
      			foreach ($link as $data) 
      			{
      				$t=$data["wen_name"];
      				$tmp=new bot($t);
      			}
      			//$tmp=new bot($link['wen_name']);
      			
      			
      }

}
?>