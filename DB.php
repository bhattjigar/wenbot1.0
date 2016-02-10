<?php 

class DB
{
	static $wen;
		function __construct($server,$user,$pw,$db)
	  {
		    try
		    {
		    		DB::$wen=new PDO("mysql:host=$server;dbname=$db",$user,$pw);
		            DB::$wen->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    }
		      
		    catch(PDOException $e)
		    {
		    	echo $e->getMessage();
		    }
		      
	   }
	   function fire($sql)
	   {

		   	try
		   	{
		   			$wen=DB::$wen->prepare($sql); 
	                $wen->execute();
		   	}
		   	catch(PDOException $e)
		   	{
		   		echo $e->getMessage();
		   	}

	   }
	   function select($sql)
	   {
		   	try
		   	{
		   		$wen=DB::$wen->prepare($sql);
		   		$wen->execute();
		   		return $wen->fetchAll();

		   	}
		   	catch(PDOException $e)
		   	{
		   		echo $e->getMessage();
		   	}
	   }

}
// END OF DB CLASS






