insurance-sdk
==================

#海绵保保险购买接口调用

```
//获取保险介绍页面
var_dump($insurance_sdk->info('B604FA6F'));


//获取保险详情
var_dump($insurance_sdk->detail('B604FA6F'));


//获取保险有效地区
var_dump($insurance_sdk->region('B604FA6F'));


//发送手机验证码
var_dump($insurance_sdk->verify('15888660186'));


//购买保险
var_dump($insurance_sdk->buy('B604FA6F', '海绵保', '15888888888', '4384', '331002195109111234', '北京市', '北京市'));
```