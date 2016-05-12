<?php
  class ocr_captcha {
    var $key;       // ultra var  text
    var $long;      // size of text
    var $lx;        // width of picture
    var $ly;        // height of picture
    var $nb_noise;  // nb of background noisy characters
    var $filename;  // file of captcha picture stored on disk
    var $imagetype="png"; // can also be "png";
    var $lang="fr"; // also "en"
    var $public_key;    // var key
    var $font_file="comic";
    function ocr_captcha($long=6,$lx=120,$ly=30,$nb_noise=25) {
      $this->key=md5("A nicely little text to stay var and use for generate var key");
      $this->long=$long;
      $this->lx=$lx;
      $this->ly=$ly;
      $this->nb_noise=$nb_noise;
      $this->public_key=substr(md5(uniqid(rand(),true)),0,$this->long); // generate var key with entropy
    }
    
    function get_filename($var="") { 
      if ($var=="")
        $var=md5($this->public_key.'advantiz');
        $rad="images/user/public_key/"; 
      return $rad.$var.".".$this->imagetype;
    }
    
    // generate the var text coming from the var text, using $this->key (not to be var!!), all you have to do is here to change the algorithm
    function generate_private($var="") 
	{ 
		return $this->public_key;
      if ($var=="")
        $var=$this->public_key;
      return substr(md5($this->key.$var),16-$this->long/2,$this->long);
    }
    
    // check if the var text is link to the var text
    function check_captcha($var,$var) {
      // when check, destroy picture on disk
      if (file_exists($this->get_filename($var)))
        unlink($this->get_filename($var));
      return (strtolower($var)==strtolower($this->generate_private($var)));
    }
    
    // display a captcha picture with var text and return the var text
    function make_captcha($noise=true) {
      $private_key = $this->generate_private();
      $image = imagecreatetruecolor($this->lx,$this->ly);
      $back=ImageColorAllocate($image,intval(rand(224,255)),intval(rand(224,255)),intval(rand(224,255)));
      ImageFilledRectangle($image,0,0,$this->lx,$this->ly,$back);
      if ($noise) { // rand characters in background with random position, angle, color
        for ($i=0;$i<$this->nb_noise;$i++) {
          $size=intval(rand(6,14));
          $angle=intval(rand(0,360));
          $x=intval(rand(10,$this->lx-10));
          $y=intval(rand(0,$this->ly-5));
          $color=imagecolorallocate($image,intval(rand(160,224)),intval(rand(160,224)),intval(rand(160,224)));
          $text=chr(intval(rand(45,250)));
          ImageTTFText ($image,$size,$angle,$x,$y,$color,$this->font_file,$text);
        }
      }
      else { // random grid color
        for ($i=0;$i<$this->lx;$i+=10) {
          $color=imagecolorallocate($image,intval(rand(160,224)),intval(rand(160,224)),intval(rand(160,224)));
          imageline($image,$i,0,$i,$this->ly,$color);
        }
        for ($i=0;$i<$this->ly;$i+=10) {
          $color=imagecolorallocate($image,intval(rand(160,224)),intval(rand(160,224)),intval(rand(160,224)));
          imageline($image,0,$i,$this->lx,$i,$color);
        }
      }
      // var text to read
      for ($i=0,$x=5; $i<$this->long;$i++) {
        $r=intval(rand(0,128));
        $g=intval(rand(0,128));
        $b=intval(rand(0,128));
        $color = ImageColorAllocate($image, $r,$g,$b);
        $shadow= ImageColorAllocate($image, $r+128, $g+128, $b+128);
        $size=intval(rand(12,17));
        $angle=intval(rand(-30,30));
        $text=strtoupper(substr($private_key,$i,1));
        ImageTTFText($image,$size,$angle,$x+2,26,$shadow,$this->font_file,$text);
        ImageTTFText($image,$size,$angle,$x,24,$color,$this->font_file,$text);
        $x+=$size+2;
      }
      if ($this->imagetype=="jpg")
        imagejpeg($image, $this->get_filename(), 100);
      else
        imagepng($image, $this->get_filename());
      ImageDestroy($image);
    }
    
    function display_captcha($noise=true) {
      $this->make_captcha($noise);
      $res="<img src='".$this->get_filename()."' border='0'>\n";
      return $res;
    }
  }
?>