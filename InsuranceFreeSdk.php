<?php
/**
 * User: air
 * Date: 14-7-16
 * Time: 下午3:51
 */

namespace okchexian;

/**
 * Class InsuranceFreeSdk
 * @package okchexian
 */
class InsuranceFreeSdk
{

    /**
     * @var string
     */
    protected $appkey = '';
    /**
     * @var string
     */
    protected $appsecret = '';

    /**
     * @var string
     */
    protected $environment = 'testing';

    /**
     * @var array
     */
    protected $connections = [
        'testing'   => 'http://api.test.baoxiandr.com',
        'production' => 'http://api.baoxiandr.com',
    ];

    /**
     * 初始化
     * @param string $appkey 分配得到
     * @param string $appsecret 分配得到
     */
    public function __construct($appkey, $appsecret, $environment = 'testing')
    {
        $this->appkey = $appkey;
        $this->appsecret = $appsecret;
        $this->environment = $environment;
    }

    /**
     * @param string $insurance_code 保险代码
     * @param string $customer_name 客户名称
     * @param string $customer_mobile 客户手机
     * @param string $customer_id_num 客户身份证
     * @param string $customer_province 客户省份
     * @param string $customer_city 客户城市
     * @param int $dealer_id 您的代理号
     * @return string 保单号
     */
    public function buy($insurance_code, $customer_name, $customer_mobile, $customer_id_num, $customer_province, $customer_city, $dealer_id = 1000)
    {
        $body = array(
            'insurance' => [
                'code' => $insurance_code,
            ],
            'customer' => [
                'contact_state' => $customer_province,
                'contact_city' => $customer_city,
                'name' => $customer_name,
                'id' => $customer_id_num,
                'mobile' => $customer_mobile,
                'verify' => rand(1234, 4321),
            ],
            'dealer' => [
                'id' => $dealer_id,
            ]
        );

        $response = \Requests::post($this->connections[$this->environment] . '/api/insurance/buy?' . $this->signature(), array('Content Type' => 'application/json'), json_encode($body));

        if ($response->status_code == '200') {
            try {
                $response = json_decode($response->body, true);
            } catch (\Exception $e) {
                return null;
            }
            return $response;
        } else {
            return null;
        }
    }

    /**
     * 发送验证码
     * @param string $mobile 手机号
     * @return mixed|null|\Requests_Response
     */
    public function verify( $mobile ){
        $body = array(
            'mobile' => $mobile,
        );
        $response = \Requests::post($this->connections[$this->environment] . '/api/verify-code?' . $this->signature(), array('Content Type' => 'application/json'), $body);

        if ( $response->status_code == '200') {
            try {
                $response = json_decode($response->body, true);
            } catch (\Exception $e) {
                return null;
            }
            return $response;
        } else {
            return null;
        }
    }

    /**
     * 保险支持城市
     * @param string $insurance_code 保险代号
     * @return mixed|null|\Requests_Response
     */
    public function region($insurance_code){
        $body = array(
            'code' => $insurance_code,
        );
        $response = \Requests::get($this->connections[$this->environment] . '/api/region?' . $this->signature() . '&' . http_build_query($body));

        try {
            $response = json_decode($response->body, true);
        } catch (\Exception $e) {
            return null;
        }
        return $response;
    }

    /**
     * 保险介绍页面
     * @param string $insurance_code 保险代号
     * @return mixed|null|\Requests_Response
     */
    public function info($insurance_code){
        $body = array(
            'code' => $insurance_code,
        );
        $response = \Requests::get($this->connections[$this->environment] . '/api/insurance/info?' . $this->signature() . '&' . http_build_query($body));

        try {
            $response = json_decode($response->body, true);
        } catch (\Exception $e) {
            return null;
        }
        return $response;
    }

    /**
     * 保险详情
     * @param string $insurance_code 保险代号
     * @return mixed|null|\Requests_Response
     */
    public function detail($insurance_code){
        $body = array(
            'code' => $insurance_code,
        );
        $response = \Requests::get($this->connections[$this->environment] . '/api/insurance/detail?' . $this->signature() . '&' . http_build_query($body));

        try {
            $response = json_decode($response->body, true);
        } catch (\Exception $e) {
            return null;
        }
        return $response;
    }

    /**
     * @return string 加密状态码
     */
    protected function signature(){
        $nonce = rand(123456, 654321);
        $timestamp = time();
        $array = [
            'appkey' => $this->appkey,
            'timestamp' => $timestamp,
            'nonce' => $nonce,
            'version' => '3',
            'signature' => sha1($nonce . $this->appsecret . $timestamp)
        ];
        return http_build_query($array);
    }
}