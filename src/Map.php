<?php
/**
 * 百度地图SDK
 * User: chocoboxxf
 * Date: 16/5/23
 * Time: 下午3:48
 */
namespace chocoboxxf\Baidu\Map;

use GuzzleHttp\Client;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Map extends Component
{
    /**
     * API接口
     */
    const API_IP_TO_LOCATION = '/location/ip'; // 根据IP返回位置信息接口
    /**
     * 百度地图开放平台AK
     * @var string
     */
    public $ak;
    /**
     * 百度地图开放平台SK
     * @var string
     */
    public $sk;
    /**
     * API服务器域名
     * @var string
     */
    public $domain = 'api.map.baidu.com';
    /**
     * API是否使用SSL连接，默认不使用
     * @var bool
     */
    public $isSecure = false;
    /**
     * API Client
     * @var \GuzzleHttp\Client
     */
    public $apiClient;

    public function init()
    {
        parent::init();
        if (!isset($this->ak)) {
            throw new InvalidConfigException('请先配置AK');
        }
        if (!isset($this->sk)) {
            throw new InvalidConfigException('请先配置SK');
        }
        $this->apiClient = new Client([
            'base_url' => [
                ($this->isSecure ? 'https://' : 'http://') . $this->domain,
                [],
            ],
        ]);
    }

    /**
     * 根据IP返回位置信息
     * @param string $ip IP地址
     * @param string $coor 坐标类型，缺省返回为百度墨卡托坐标，bd09ll时，返回为百度经纬度坐标
     * @return mixed
     */
    public function ipToLocation($ip, $coor = '')
    {
        // 公共参数
        $data = [
            'ak' => $this->ak,
        ];

        // 入参
        $data['ip'] = $ip;
        $data['coor'] = $coor;

        // 签名前先排序参数
        ksort($data);
        $signature = $this->getSignature(self::API_IP_TO_LOCATION, $data);
        $data['sn'] = $signature;

        // 请求
        $response = $this->apiClient->get(
            self::API_IP_TO_LOCATION,
            [
                'query' => $data,
            ]
        );
        $result = $response->json();
        return $result;
    }

    /**
     * 生成sn签名
     * @param string $url 请求URI
     * @param array $params 入参
     * @return string
     */
    public function getSignature($url, $params = [])
    {
        $queryString = http_build_query($params);
        return md5(urlencode($url.'?'.$queryString.$this->sk));
    }
}