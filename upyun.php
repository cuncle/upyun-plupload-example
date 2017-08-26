<?php
//必须需要修改的参数
//#################################################################################################
$bucket = 'bucket';//又拍云的服务名
//$form_api_secret = 'form_api_secret';//表单密钥：后台——>空间——>通用——>基本设置
$operator ='operator'; //授权的操作员
$password = md5('password'); // 授权的操作员密码
//#################################################################################################
$GMTdate = gmdate('D, d M Y H:i:s') . ' GMT';
$method = 'POST';
$URI = '/'.$bucket;
$options = array();
$options['bucket'] = $bucket;
$options['expiration'] = time()+3600;
$options['save-key'] = '/{year}/{mon}/{day}/upload_{filename}{.suffix}';//save-key 详细说明可以看官方文档
$options['date'] = $GMTdate;
$policy = base64_encode(json_encode($options));//policy 生成
$str = $method.'&'.$URI.'&'.$GMTdate.'&'.$policy;
$signature = base64_encode(hash_hmac('sha1',$str, $password, true));
$authorization = "UPYUN {$operator}:{$signature}";
//$signature = md5($policy.'&'.$form_api_secret);// sigenature生成
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

<title>Plupload to UPYUN Example</title>

<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

<!-- Load plupload and all it's runtimes and finally the UI widget -->
<link rel="stylesheet" href="./js/jquery.ui.plupload/css/jquery.ui.plupload.css" type="text/css" />


<!-- production -->
<script type="text/javascript" src="js/plupload.full.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.plupload/jquery.ui.plupload.js"></script>

<!-- debug
<script type="text/javascript" src="../../js/moxie.js"></script>
<script type="text/javascript" src="../../js/plupload.dev.js"></script>
<script type="text/javascript" src="../../js/jquery.ui.plupload/jquery.ui.plupload.js"></script>
-->

</head>
<body style="font: 13px Verdana; background: #eee; color: #333">

<h1>Plupload to UPYUN Example</h1>

<div id="uploader">
    <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
</div>

<script type="text/javascript">
// Convert divs to queue widgets when the DOM is ready
$(function() {
	$("#uploader").plupload({
		runtimes : 'html5,flash,silverlight',
		url : 'http://v0.api.upyun.com/' + '<?php echo $bucket; ?>',
		multipart: true,
		multipart_params: {
			'key': '${filename}', // use filename as a key
			'Filename': '${filename}', // adding this to keep consistency across the runtimes
			'Content-Type': '',
			'policy': '<?php echo $policy; ?>',
      'authorization': '<?php echo $authorization;?>'
			/*'signature': '<?php echo $signature; ?>' */
		},

		flash_swf_url : 'js/Moxie.swf',
		silverlight_xap_url : 'js/Moxie.xap'
	});
});
</script>

</body>
</html>
