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

//获取保险介绍页面
var_dump($insurance_sdk->info('B604FA6F'));


//获取保险详情
var_dump($insurance_sdk->detail('B604FA6F'));


//获取保险有效地区
var_dump($insurance_sdk->region('B604FA6F'));


//发送手机验证码
var_dump($insurance_sdk->verify('15888661177'));


//购买保险
var_dump($insurance_sdk->buy('B604FA6F', '保橙网络', '15888661177', '7595', '331002199109241177', '北京市', '北京市', 1001));
```
