<?php 
// create a new cURL resource
                $url="https://yts.ag/torrent/download/85A96231386137857F8F4E2794AD6ADAE601BC40.torrent";
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

                    $html=curl_exec($ch);


$report=curl_getinfo($ch);
print_r($report);
if(strpos($report['content_type'], 'text') === FALSE)
{
    echo "nai malyu";
    
}
else
{
    echo "malyu";
}

echo "<pre>".htmlspecialchars($html)."</pre>";
// grab URL and pass it to the browser


if(curl_errno($ch)) {
   echo 'Curl error: ' . curl_error($ch);
}

print curl_error($ch);

// close cURL resource, and free up system resources
curl_close($ch);
?>