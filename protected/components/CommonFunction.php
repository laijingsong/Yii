<?php

/**
 * 公共方法
 */
class CommonFunction {
	/**
	 * json信息提示,配合前端弹出窗
	 * @param int $alerttype
	 * @param string $sign
	 * @param string $msg
	 * @param string $jumpurl
	 */
	public function jsonMessage($alerttype, $sign, $msg, $jumpurl) {
		$result['alerttype'] = $alerttype;
		$result['sign'] = $sign;
		$result['msg'] = $msg;
		$result['url'] = $jumpurl;
		echo json_encode($result);
		exit;
	}
	
	/**
	 * 上传图片
	 * @param string $filesname 图片标签的name
	 * @param int $filesize 图片的大小 以 bit为单位
	 * @param string $savepath 图片保存的路径
	 * @param int $watermark 是否加水印
	 * @param string $waterimagepath 水银图片的路径
	 * @param int $waterposition 水印的位置
	 */
	public function uploadPicture($filesname, $filesize, $savepath, $watermark, $waterimagepath, $waterposition) {
		if($_FILES[$filesname]['tmp_name']) {
			//上传文件类型列表
			$uptypes = array(
					'image/jpg',
					'image/jpeg',
					'image/png',
					'image/pjpeg',
					'image/gif',
					'image/x-png'
			);
			$overwrite=false;
			$max_file_size = $filesize; //上传文件大小限制, 单位BYTE
			$destination_folder = $savepath; //上传文件路径
			$waterpic = $waterimagepath; //水印图片
			$watermark = $watermark; //是否附加水印(1为加水印,0为不加水印);
			$waterposition = $waterposition; //水印位置参考watermark函数中的参数;
			
				if(!is_uploaded_file($_FILES[$filesname]['tmp_name'])) {
					$this->jsonMessage('3', 'error', '图片不存在！', '');
				}
		
				$file = $_FILES[$filesname];
				if($max_file_size < $file['size']) {
					$this->jsonMessage('3', 'error', '文件太大，不能超过2M！', '');
				}
		
				if(!in_array($file['type'], $uptypes)) {
					$this->jsonMessage('3', 'error', '文件类型不符，类型应为：jpg、gif、png！', '');
				}
		
				if(!file_exists($destination_folder)) {
					mkdir($destination_folder);
				}
		
				$filename = $file['tmp_name'];
				$image_size = getimagesize($filename);
				$pinfo=pathinfo($file['name']);
				$ftype=$pinfo['extension'];
				$destination = $destination_folder.time().rand(0,9).".".$ftype;
				if (file_exists($destination) && $overwrite != true) {
					$this->jsonMessage('3', 'error', '同名文件已经存在了！', '');
				}
		
				if(!move_uploaded_file ($filename, $destination)) {
					$this->jsonMessage('3', 'error', '移动文件出错！', '');
				}
				//$pinfo = pathinfo($destination);
				//$fname = $pinfo['basename'];//图片名称
				if($watermark) {
					$this->countMemory($image_size);
					$this->createWatermark($destination, $waterpic, $waterposition);
				}
				return $destination;
		}
	}
	
	/**
	 * 创建水印
	 */
	public function createWatermark($background, $waterpic, $waterposition) {
	
		$ground_info = getimagesize($background);
		$ground_w = $ground_info[0];
		$ground_h = $ground_info[1];
	
		switch($ground_info[2]) {
			case 1:
				$back = imagecreatefromgif($background);
				break;
			case 2:
				$back = imagecreatefromjpeg($background);
				break;
			case 3:
				$back = imagecreatefrompng($background);
				break;
			default:
				$this->jsonMessage('3', 'error', '文件类型不符，类型应为：jpg、gif、png！', '');
		}
	
		$water = imagecreatefromgif($waterpic);
		$water_info = getimagesize($waterpic);
		$water_w = $water_info[0];//取得水印图片的宽
		$water_h = $water_info[1];//取得水印图片的高
	
		switch($waterposition) {
			case 0://随机
				$posX = rand(0,($ground_w - $water_w));
				$posY = rand(0,($ground_h - $water_h));
				break;
			case 1://1为顶端居左
				$posX = 0;
				$posY = 0;
				break;
			case 2://2为顶端居中
				$posX = ($ground_w - $water_w) / 2;
				$posY = 0;
				break;
			case 3://3为顶端居右
				$posX = $ground_w - $water_w;
				$posY = 0;
				break;
			case 4://4为中部居左
				$posX = 0;
				$posY = ($ground_h - $water_h) / 2;
				break;
			case 5://5为中部居中
				$posX = ($ground_w - $water_w) / 2;
				$posY = ($ground_h - $water_h) / 2;
				break;
			case 6://6为中部居右
				$posX = $ground_w - $water_w;
				$posY = ($ground_h - $water_h) / 2;
				break;
			case 7://7为底端居左
				$posX = 0;
				$posY = $ground_h - $water_h;
				break;
			case 8://8为底端居中
				$posX = ($ground_w - $water_w) / 2;
				$posY = $ground_h - $water_h;
				break;
			case 9://9为底端居右
				$posX = $ground_w - $water_w;
				$posY = $ground_h - $water_h;
				break;
			default://随机
				$posX = rand(0,($ground_w - $water_w));
				$posY = rand(0,($ground_h - $water_h));
				break;
		}
	
		imagecopy($back,$water,$posX,$posY,0,0,$water_w,$water_h);
		switch($ground_info[2]) {
			case 1:
				imagejpeg($back,$background);
				break;
			case 2:
				imagejpeg($back,$background);
				break;
			case 3:
				imagepng($back,$background);
				break;
			default:
				$this->jsonMessage('3', 'error', '文件类型不符，类型应为：jpg、gif、png！', '');
		}
		imagedestroy($back);
		imagedestroy($water);
	}
	
	/**
	 * 动态计算上传图片所需的内存
	 */
	public	function countMemory($imageInfo) {
		$MB = Pow(1024,2);
		$K64 = Pow(2,16);
		$TWEAKFACTOR = 1.8;
		$memoryNeeded = round( ( $imageInfo[0] * $imageInfo[1] * $imageInfo['bits'] * $imageInfo['channels'] / 8 + $K64) * $TWEAKFACTOR);
		$memoryHave = memory_get_usage();
		$memoryLimitMB = (integer) ini_get('memory_limit');
		$memoryLimit = @$memoryLimit * $MB;
		if( function_exists('memory_get_usage') && $memoryHave + $memoryNeeded > $memoryLimit ) {
			$newLimit = $memoryLimitMB + ceil( ( $memoryHave + $memoryNeeded - $memoryLimit ) / $MB );
			ini_set( 'memory_limit', $newLimit . 'M' );
		}
	}
	
	/**
	 * 字符串截取
	 */
	public function cutstr($string, $length, $dot = ' ...') {
		$charset = 'utf-8';
		if(strlen($string) <= $length) {
			return $string;
		}
	
		$pre = chr(1);
		$end = chr(1);
		$string = str_replace(array('&amp;', '&quot;', '&lt;', '&gt;'), array($pre.'&'.$end, $pre.'"'.$end, $pre.'<'.$end, $pre.'>'.$end), $string);
	
		$strcut = '';
		if(strtolower($charset) == 'utf-8') {
	
			$n = $tn = $noc = 0;
			while($n < strlen($string)) {
	
				$t = ord($string[$n]);
				if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
					$tn = 1; $n++; $noc++;
				} elseif(194 <= $t && $t <= 223) {
					$tn = 2; $n += 2; $noc += 2;
				} elseif(224 <= $t && $t <= 239) {
					$tn = 3; $n += 3; $noc += 2;
				} elseif(240 <= $t && $t <= 247) {
					$tn = 4; $n += 4; $noc += 2;
				} elseif(248 <= $t && $t <= 251) {
					$tn = 5; $n += 5; $noc += 2;
				} elseif($t == 252 || $t == 253) {
					$tn = 6; $n += 6; $noc += 2;
				} else {
					$n++;
				}
	
				if($noc >= $length) {
					break;
				}
	
			}
			if($noc > $length) {
				$n -= $tn;
			}
	
			$strcut = substr($string, 0, $n);
	
		} else {
			$_length = $length - 1;
			for($i = 0; $i < $length; $i++) {
				if(ord($string[$i]) <= 127) {
					$strcut .= $string[$i];
				} else if($i < $_length) {
					$strcut .= $string[$i].$string[++$i];
				}
			}
		}
	
		$strcut = str_replace(array($pre.'&'.$end, $pre.'"'.$end, $pre.'<'.$end, $pre.'>'.$end), array('&amp;', '&quot;', '&lt;', '&gt;'), $strcut);
	
		$pos = strrpos($strcut, chr(1));
		if($pos !== false) {
			$strcut = substr($strcut,0,$pos);
		}
		return $strcut.$dot;
	}
	
	/**
	 * 时间转换
	 */
	public function dateConvert($time) {
		$date = time()-$time;
		if($date>(3600*24*10)) {
			return date('Y-m-d', $time);
		} elseif($date>=(3600*24) AND $date<=(3600*24*10)) {
			$day = round($date/86400);
			return $day.'天前';
		} elseif($date>=3600 AND $date<=(3600*24)) {
			$day = round($date/3600);
			return $day.'小时前';
		} elseif($date>=60 AND $date<3600) {
			$day = round($date/60);
			return $day.'分钟前';
		} elseif($date<60) {
			return $date.'秒前';
		}
	}
	
	/**
	 * 内容过滤
	 */
	public function dhtmlspecialchars($string, $flags = null) {
		if(is_array($string)) {
			foreach($string as $key => $val) {
				$string[$key] = dhtmlspecialchars($val, $flags);
			}
		} else {
			if($flags === null) {
				$string = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string);
				if(strpos($string, '&amp;#') !== false) {
					$string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1', $string);
				}
			} else {
				if(PHP_VERSION < '5.4.0') {
					$string = htmlspecialchars($string, $flags);
				} else {
					if(strtolower(CHARSET) == 'utf-8') {
						$charset = 'UTF-8';
					} else {
						$charset = 'ISO-8859-1';
					}
					$string = htmlspecialchars($string, $flags, $charset);
				}
			}
		}
		return $string;
	}
	
	/**
	 * 信息提示
	 * @param 提示信息 $message
	 * @param 跳转地址 $url
	 * @param 错误信息还是正确信息 $status
	 */
	public function message($message, $url, $status) {
		$url = $url?$url:"javascript:history.go(-1)";
		$ico = $status?":)":":(";
		print <<<EOT
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>跳转提示</title>
			<style type="text/css">
			*{ padding: 0; margin: 0; }
			body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
			.system-message{ padding: 24px 48px; }
			.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
			.system-message .jump{ padding-top: 10px}
			.system-message .jump a{ color: #333;}
			.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 26px }
			.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
			</style>
			</head>
			<body>
			<div class="system-message">
			<h1>$ico</h1>
			<p class="success">$message</p>
			<p class="detail"></p>
			<p class="jump">
			页面自动 <a id="href" href="$url">跳转</a> 等待时间： <b id="wait">3</b>
			</p>
			</div>
			<script type="text/javascript">
			(function(){
			var wait = document.getElementById('wait'),href = document.getElementById('href').href;
			var interval = setInterval(function(){
				var time = --wait.innerHTML;
				if(time == 0) {
					location.href = href;
					clearInterval(interval);
				};
			}, 1000);
			})();
			</script>
			</body>
			</html>
EOT;
		exit;
	}
}