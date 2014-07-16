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

    protected $environment = 'testing';

    protected $connections = [
//        'testing'   => 'http://api.test.baoxiandr.com',
        'testing' => 'http://127.0.0.1:85',
        'production' => 'http://api.baoxiandr.com',
    ];

    /**
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