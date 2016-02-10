<?php 

class bot
{
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
        		  $curl = curl_init();

			      $header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
			      $header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
			      $header[] = "Cache-Control: max-age=0";
			      $header[] = "Connection: keep-alive";
			      $header[] = "Keep-Alive: 300";
			      $header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
			      $header[] = "Accept-Language: en-us,en;q=0.5";
			      $header[] = "Pragma: ";

			      curl_setopt($curl, CURLOPT_URL, $url);
			      //curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36");
			      curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Wenbot/1.0; +http://www.Timeswen.com/wenbot");
			      curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
			      curl_setopt($curl, CURLOPT_ENCODING, "gzip,deflate");
			      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			      curl_setopt($curl, CURLOPT_AUTOREFERER, true);
			      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			      curl_setopt($curl, CURLOPT_FOLLOWLOCATION,true);
				  $this->html=curl_exec($curl);
				  curl_close($curl);

        	}
		}
		catch(Exception $e)
		{
			echo $e->getMesage();
		}
          
      
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
    public function DOMAIN()
    {
    	try
    	{
    		$url=$this->url;

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
		          	return $regs['domain'];
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
    		foreach ($tmp as $tag) 
    		{

    			foreach($this->dom->getElementsByTagName($tag) as $node )
		        {
		        	foreach ($node->attributes as $attrName => $attrNode)
		        	 {
		        	 	
		        		$this->node[trim($node->nodeName)][trim($attrName)][trim($attrNode->nodeValue)]="";
		        	 }
		          
		        }	
    		}
    		
    	}
    	catch(Exception $e)
    	{
    		echo $e->getMesage();
    	}
		 
    }

}
?>