<?php
namespace app\index\controller;
use think\Controller;

class Api extends Controller
{
    private $a, $b, $c, $d;  
    private $n_iter,$sign;  
    private $key = [0x789f5645, 0xf68bd5a4, 0x81963ffa, 0x458fac58];
    public function index(){
        var_dump($this->key);
        $dict = ['channelMark'=>"12","userId"=>"348598","lastLoginTime"=>"1513739029036"];
        $param = json_encode($dict);
        $enc = $param;
        for($i =0;$i<count($this->key);$i++){
            $enc = $this->encrypt($enc,$this->key[$i]);
        }
        echo $enc;
        // echo json_encode($dict);
    }

    public function __construct() {  
        $this->setIter ( 16 );  
    }  
    private function setIter($n_iter) {  
        $this->n_iter = $n_iter;  
    }  
    private function getIter() {  
        return $this->n_iter;  
    }  
    public function setSign($sign)  
    {  
        return $this->sign=$sign;  
    }  
    public function getSign()  
    {  
        return $this->sign;  
    }  
    public function encrypt($data, $key) {  
        $sign = 8-strlen($data)%8;//此值为需要补齐的8的倍数值  重点  
         
        $n = $this->_resize ( $data, 8 );  
          
        $data_long [0] = $sign; //加密的第一位,此值为需要补齐的8的倍数值  
       // $this->setSign($sign);  
         // 重点 格式化数据 按照 Little—Endian 顺序  
        $n_data_long = $this->_str2long ( 1, $data, $data_long );   
  
        // 格式化 key 到128位16个字节 一个字节8位  
        $this->_resize ( $key, 16, true );  
   
        if ('' == $key)  
            $key = '0000000000000000';  
             
        // convert key to long  
        $n_key_long = $this->_str2long ( 0, $key, $key_long );// 重点  
        
        // encrypt the long data with the key  
        $enc_data = '';  
        $w = array (0, 0 );  
        $j = 0;  
        $k = array (0, 0, 0, 0 );  
          
        for($i = 0; $i < $n_data_long; $i=$i+2) { //n_data_long 为一个整型的 数据数组长度值 这个数组是存放着 转换之后的 数据值  
            // get next key part of 128 bits  
            if ($j + 4 <= $n_key_long) {  
                $k [0] = $key_long [$j];  
                $k [1] = $key_long [$j + 1];  
                $k [2] = $key_long [$j + 2];  
                $k [3] = $key_long [$j + 3];  
            }  
  
            $this->_encipherLong ( $data_long [$i], $data_long [$i+1], $w, $k );  
             
            // append the enciphered longs to the result  
            $enc_data .= $this->_long2str ( $w [0] );  
            $enc_data .= $this->_long2str ( $w [1] );  
        }  
         
        return $enc_data;  
    }  
    public function decrypt($enc_data, $key) {  
        // convert data to long  
        $n_enc_data_long = $this->_str2long ( 0, $enc_data, $enc_data_long );  
         
        // resize key to a multiple of 128 bits (16 bytes)  
        $this->_resize ( $key, 16, true );  
        if ('' == $key)  
            $key = '0000000000000000';  
             
        // convert key to long  
        $n_key_long = $this->_str2long ( 0, $key, $key_long );  
          
        // decrypt the long data with the key  
        $data = '';  
        $w = array (0, 0 );  
        $j = 0;  
        $len = 0;  
        $k = array (0, 0, 0, 0 );  
        $pos = 0;  
         
        for($i = 0; $i < $n_enc_data_long; $i += 2) {  
            // get next key part of 128 bits  
            if ($j + 4 <= $n_key_long) {  
                $k [0] = $key_long [$j];  
                $k [1] = $key_long [$j + 1];  
                $k [2] = $key_long [$j + 2];  
                $k [3] = $key_long [$j + 3];  
            }            
            $this->_decipherLong ( $enc_data_long [$i], $enc_data_long [$i + 1], $w, $k );  
           if($i==0)  
            {  
              $this->setSign($w [0]);//截取补出来的空位  
            }  
            $data .= $this->_long2str ( $w [0] );  
            $data .= $this->_long2str ( $w [1] );  
  
        }   
              
        return $data;  
    }  
    private function _encipherLong($y, $z, &$w, &$k) {  
        $sum = ( integer ) 0;  
        $delta = 0x9e3779b9;  
          
        $n = ( integer ) $this->n_iter;  
        $bjz_int = PHP_INT_MAX; //整型的边界值  
        while ( $n -- > 0 ) {  
            $sum += $delta;  
              
            $y += (($z << 4) + $k[0]) ^ ($z + $sum) ^ (($z >> 5) + $k[1]);  
              
            if($y <= -$bjz_int)// 调整位移值的关键值  
            {  
                $y=$y+4294967296;  
            }  
            else if($y >= $bjz_int)  
            {  
                $y=$y-4294967296;  
            }   
                        
            $z += (($y << 4) + $k[2]) ^ ($y + $sum) ^ (($y >> 5) + $k[3]);  
              
            // 调整位移值的关键值  
            if($z <= -$bjz_int)  
            {  
                $z=$z+4294967296;  
            }  
            else if($z >= $bjz_int)  
            {  
                $z=$z-4294967296;  
            }  
        }  
  
        $w [0] = $y;  
        $w [1] = $z;  
    }  
    private function _decipherLong($y, $z, &$w, &$k) {  
        // sum = delta<<5, in general sum = delta * n  
        $n = ( integer ) $this->n_iter;  
           
        $delta = 0x9E3779B9;  
        if($n==16)  
        {  
           $sum = 0xE3779B90;  
        }  
        else if($n==32)  
        {  
            $sum = 0xC6EF3720;  
        }  
        else   
        {  
            $sum = $delta * $n;  
        }  
         $bjz_int = PHP_INT_MAX; //整型的边界值  
        while ( $n -- > 0 ) {  
             $wy=$y+$sum;// 位移调整量  
  
           if($wy>=$bjz_int)  
            {  
                $wy = $wy-4294967296;  
            }  
            else if($wy<=-$bjz_int)  
            {  
                $wy = $wy+4294967296;  
            }  
            $z -= (($y << 4) + $k[2]) ^ ($wy) ^ (($y >> 5) + $k[3]);  
              
            // 调整位移值的关键值  
            if($z<=-$bjz_int)  
            {  
                $z = $z+4294967296;  
            }  
            else if($z>=$bjz_int)  
            {  
                $z = $z-4294967296;  
            }  
              
             $wz = $z+$sum;// 位移调整量  
             if($wz>=$bjz_int)  
               {  
                 $wz = $wz-4294967296;  
               }  
               else if($wz<=-$bjz_int)  
               {  
                 $wz = $wz+4294967296;  
               }  
            $y -= (($z << 4) + $k[0]) ^ ($wz) ^ (($z >> 5) + $k[1]);  
              
            // 调整位移值的关键值  
           if($y<=-$bjz_int)  
            {  
                $y = $y+4294967296;  
            }  
            else if($y>=$bjz_int)  
            {  
                $y = $y-4294967296;  
            }         
  
            $sum -= $delta;  
            if($sum>=$bjz_int)//调整sum步数  
            {  
                $sum = $sum-4294967296;  
            }  
            else if ($sum<=-$bjz_int)  
            {  
                $sum = $sum+4294967296;  
            }  
            }  
              
        $w [0] = $y;  
        $w [1] = $z;  
  
    }  
    private function _resize(&$data, $size, $nonull = false) {  
        $dach='';// 重点  
        $n = strlen ( $data );    
        if($data=='%9^q69LE$Omg:ion')//修改密钥  
    //  if($data=='lzm0FfyAtjAOc6:y')//修改密钥  
        {  
            $nmod = $n % $size;  
        }  
        else {  
            $nmod = 8-$n%$size-4;  
        }     
  
         if($nmod>0)//大于0 就补齐空位  
         {  
            for($i=0;$i<$nmod;$i++)  
                {  
                  $dach .= chr(0);//为了测试写为固定值  
                }  
            $data = $dach.$data; //补齐空位 方便移位  
         }  
        return $n;  
    }  
     
    private function _str2long($start, &$data, &$data_long) {  
          
        $n = strlen ( $data );  
          
        $tmp = unpack ( 'V*', $data );//无符号长整形 高位在前 低位在后  
          
        $j = $start;  
         
        foreach ( $tmp as $value )  
        {  
           $data_long [$j ++] = $value;  
        }  
          
        return $j;  
    }  
    private function _long2str($l) {  
        return pack ( 'V', $l );  
    }  
  
  //记录日志的函数  
  function writelog($str)  
  {  
    $showtime = date("Y-m-d H:i:s");  
    $file = "/home/nemo/data/jmlog/jmlog.log";  
    $file_pointer = fopen($file,"a");  
    fwrite($file_pointer,$showtime." #5880 Message: ");  
    fwrite($file_pointer,$str."\r\n");  
    fclose($file_pointer);  
      
      
  }  
  //读文件  
   function readstr() {  
    $fpath = "/home/nemo/apache/htdocs/tea/sysbian.txt";  
    $ftext = file_get_contents($fpath);  
    return $ftext;  
   }  
// 写文件  
   function writestr($str) {  
    $fpath = "/home/nemo/apache2/htdocs/tea/sysbian.txt";  
    $fp = fopen ( $fpath, 'a' );  
    fwrite ( $fp, $str );  
    fclose ( $fp );  
  }  
  //提供函数的计算时间  
    function get_microtime(){    
       list($usec, $sec) = explode(' ', microtime());    
       return ((float)$usec + (float)$sec);    
}  
}  
