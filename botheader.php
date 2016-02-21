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
			      curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.124 Safari/537.36");
			      //curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Wenbot/1.0; +http://www.Timeswen.com/wenbot");
			      curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
			      
			      /*curl_setopt($curl, CURLOPT_ENCODING, "gzip,deflate");*/
			      curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

			      /*curl_setopt($curl, CURLOPT_AUTOREFERER, true);
			      
			      curl_setopt($curl, CURLOPT_FOLLOWLOCATION,true);*/
			      $report=curl_getinfo($curl);
				  print_r($report);
			      $this->html=curl_exec($curl);