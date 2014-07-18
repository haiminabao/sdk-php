<?php
/**
 * User: air
 * Date: 14-7-16
 * Time: 下午4:19
 */

use haimianbao\InsuranceSdk;
require __DIR__ . '/../../../autoload.php';

$appkey = '';
$appsecret = '';

//InsuranceSdk::ENV_TEST 测试环境
//InsuranceSdk::ENV_PRO 正式环境
$insurance_sdk = new InsuranceSdk( $appkey, $appkey, InsuranceSdk::ENV_TEST );


//获取保险介绍页面
//var_dump($insurance_sdk->info('B604FA6F'));


//获取保险详情
var_dump($insurance_sdk->detail('B604FA6F'));


//获取保险有效地区
//var_dump($insurance_sdk->region('B604FA6F'));


//发送手机验证码
//var_dump($insurance_sdk->verify('15888661177'));


//购买保险
//var_dump($insurance_sdk->buy('B604FA6F', '保橙网络', '15888661177', '7595', '331002199109241177', '北京市', '北京市', 1001));
