insurance-sdk
==================


## 安装

> 终端

```php
composer require "haimianbao/insurance-sdk":"dev-master"
```
> composer.json

```php
"require": {
   "haimianbao/insurance-sdk" : "dev-master"
}
```
## 海绵保保险购买接口调用使用

```
use haimianbao\InsuranceSdk;
require __DIR__ . '/vendor/autoload.php';

$insurance_sdk = new InsuranceSdk( $appkey, $appsecret, 'testing' );


$insurance_code = 'B604FA6F';    //保险险种代号  每种保险对应一个
//获取保险介绍页面
var_dump($insurance_sdk->info($insurance_code));


//获取保险详情
var_dump($insurance_sdk->detail($insurance_code));


//获取保险有效地区
var_dump($insurance_sdk->region($insurance_code));


$mobile = '15888661177';   //用户手机号
//发送手机验证码
var_dump($insurance_sdk->verify($mobile));


//购买保险
//城市根据 $insurance_sdk->region($insurance_code) 中获取的 地区
var_dump($insurance_sdk->buy($insurance_code, '用户姓名', $mobile, '手机验证码 int(4)', '身份证号 string(18)', '用户省份 string(16) 如:北京市', '用户城市 string(16) 如:北京市', '您的代理号 int(4)'));
```
