<?php
set_time_limit(300);
/** 
  * @desc The Class the generate video thunmnail 
  * 
*/
 class thumbnail{
 
    private  $url;
	
	private $patterns=array('/youtub/','/vimeo/','/dailymotion/','/hulu/','/ustream/','/viddler/',
	                        '/animoto/','/nfb/','/screenr/','/funnyordie/','/ted/','/coub/','/blip/',
							'/ora/','/aol/','/collegehumor/','/jest/','/rdio/','/mixcloud/','/soundcloud/',
							'/dotsub/','/chirb/');
	
	
 
 public function __construct($url){
	
	 $this->url=$url;
	}

 public function cURL($url){
   $ch = curl_init();
    // Disable SSL verification
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   // Will return the response, if false it print the response
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,0);
  curl_setopt($ch,CURLOPT_TIMEOUT,0);
   // Set the url
   curl_setopt($ch, CURLOPT_URL,$url);
   // Execute
   $result=curl_exec($ch);
   // Closing
   curl_close($ch);
   
  return json_decode($result);

 } 
 
 public  function Media_ID(){
 
    if(preg_match($this->patterns[0],($this->url))){
  
    $url2= "http://www.youtube.com/oembed?url=$this->url&format=json";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src);
   }
    else if(preg_match($this->patterns[1],($this->url))){
    $url2= "http://vimeo.com/api/oembed.json?url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src);
   }
    else if(preg_match($this->patterns[2],($this->url))){
    $url2="http://www.dailymotion.com/services/oembed?format=json&url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src);
   }
    else if(preg_match($this->patterns[3],($this->url))){
    $url2= "http://www.hulu.com/api/oembed.json?url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->large_thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src);
   }
    else if(preg_match($this->patterns[4],($this->url))){
    $url2= "http://www.ustream.tv/oembed?url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/value="([^"]+)"/',$iframe,$matches);
    $value=$matches[1];
    preg_match('/(v|c)id=([^"]+)/',$value,$matches2);
  
    $src="http://www.ustream.tv/embed/$matches2[2]";
    return  array($thumb,$src);
   }
    else if(preg_match($this->patterns[5],($this->url))){
    $url2= "http://www.viddler.com/oembed/?format=json&url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src);
   }
    else if(preg_match($this->patterns[6],($this->url))){
    $url2= "http://animoto.com/oembeds/create/?format=json&url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src);
   }
     else if(preg_match($this->patterns[7],($this->url))){
    $url2= "http://www.nfb.ca/remote/services/oembed/?format=json&url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src=&quot;([^\s]+)&quot;/i',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src);
   } 
    else if(preg_match($this->patterns[8],($this->url))){
    $url2= "http://www.screenr.com/api/oembed.json?url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src);
   }
    else if(preg_match($this->patterns[9],($this->url))){
    $url2= "http://www.funnyordie.com/oembed.json?url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src);
   } 
     else if(preg_match($this->patterns[10],($this->url))){
    $url2= "http://www.ted.com/talks/oembed.json?url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src);
   } 
     else if(preg_match($this->patterns[11],($this->url))){
    $url2= "http://coub.com/api/oembed.json?url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src);
   } 
    else if(preg_match($this->patterns[12],($this->url))){
    $url2= "http://blip.tv/oembed/?url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src);
   } 
    else if(preg_match($this->patterns[13],($this->url))){
	$vid= substr($this->url,-14,14);
    $url2= "https://www.ora.tv/oembed/$vid?format=json";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src);
   }
    else if(preg_match($this->patterns[14],($this->url))){
	$url2= "http://on.aol.com/api?url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match("/src='([^']+)'/",$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src);
   } 
    else if(preg_match($this->patterns[15],($this->url))){
	$url2= "http://www.collegehumor.com/oembed.json?url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src);
   } 
    else if(preg_match($this->patterns[16],($this->url))){
	$url2= "http://www.jest.com/oembed.json?url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src); 
   }
    else if(preg_match($this->patterns[17],($this->url))){
	$url2= "http://www.rdio.com/api/oembed/?format=json&url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src); 
   } 
    else if(preg_match($this->patterns[18],($this->url))){
	$url2= "http://www.mixcloud.com/oembed/?format=json&url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->image;  
    $iframe=$json->embed;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src); 
   } 
    else if(preg_match($this->patterns[19],($this->url))){
	$url2= "https://soundcloud.com/oembed?format=json&url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src); 
   }
     else if(preg_match($this->patterns[20],($this->url))){
	$url2= "http://dotsub.com/services/oembed?format=json&url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src); 
   } 
    
    else if(preg_match($this->patterns[21],($this->url))){
	$url2= "http://chirb.it/oembed.json?url=$this->url";
    $json=$this->cURL($url2);
    $thumb=$json->thumbnail_url;  
    $iframe=$json->html;
    preg_match('/src="([^"]+)"/',$iframe,$matches);
    $src=$matches[1];
  
    return  array($thumb,$src); 
   }    
 }
}
?>