<?php
/**
 * User: air
 * Date: 14-7-16
 * Time: 下午4:19
 */

use haimianbao\InsuranceSdk;
require __DIR__ . '/../../../autoload.php';

$insurance_sdk = new InsuranceSdk( 'c4ca4238a0b923820dcc509a6f75849b', 'dedc44b3ab0e8e341260c14169792aff', 'testing' );


//获取保险介绍页面
//var_dump($insurance_sdk->info('B604FA6F'));


//获取保险详情
var_dump($insurance_sdk->detail('B604FA6F'));


//获取保险有效地区
//var_dump($insurance_sdk->region('B604FA6F'));


//发送手机验证码
//var_dump($insurance_sdk->verify('15888660186'));


//购买保险
//var_dump($insurance_sdk->buy('B604FA6F', '保橙网络', '15888660186', '331002199109241234', '北京市', '北京市'));
