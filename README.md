**UPYUN-Plupload上传Demo**

一个基于 又拍云云存储 及Plupload 开发的上传Demo

**依赖**

1、Plupload 2.1.2

2、UPYUN HTTP FORM API

**安装和运行程序**

获取源代码： git clone https://github.com/cuncle/upyun-plupload-example.git

编辑 upyun.php 文件，填写您的BUCKET和Form_api_secret，表单密钥通过后台——>空间——>通用——>基本设置获取。

**说明**

根据[Upload to Amazon S3](https://github.com/moxiecode/plupload/blob/master/examples/jquery/s3.php)这个东西改了一个PHP版本的，简单的结合我们的Form API实现文件的上传。

通过UPYUN-Plupload上传Demo上传文件后，可以通过UPYUN外链方式访问获取上传的文件。
