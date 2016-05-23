# yii2-baidu-map-sdk
基于Yii2实现的百度地图API SDK（目前开发中）

环境条件
--------
- >= PHP 5.4
- >= Yii 2.0
- >= GuzzleHttp 5.0

安装
----

添加下列代码在``composer.json``文件中并执行``composer update --no-dev``操作

```json
{
    "require": {
       "chocoboxxf/yii2-baidu-map-sdk": "dev-master"
    }
}
```

设置方法
--------

```php
// 全局使用
// 在config/main.php配置文件中定义component配置信息
'components' => [
  .....
  'map' => [
    'class' => 'chocoboxxf\Baidu\Map\Map',
    'ak' => '1234', // 百度地图开放平台AK
    'sk' => '12345678', // 百度地图开放平台SK
  ]
  ....
]
// 代码中调用
$result = Yii::$app->map->ipToLocation('220.181.57.217', 'bd09ll');
....
```

```php
// 局部调用
$map = Yii::createObject([
    'class' => 'chocoboxxf\Baidu\Map\Map',
    'ak' => '1234', // 百度地图开放平台AK
    'sk' => '12345678', // 百度地图开放平台SK
]);
$result = $map->ipToLocation('220.181.57.217', 'bd09ll');
....
```

使用示例
--------

根据IP返回位置信息接口

```php
$result = Yii::$app->map->ipToLocation('220.181.57.217', 'bd09ll');
if (isset($result['status']) && $result['status'] === 0) {
    // 正常情况
    // 返回数据格式
    // {
    //     "address": "CN|北京|北京|None|CHINANET|0|0",
    //     "content": {
    //         "address": "北京市",
    //         "address_detail": {
    //             "city": "北京市",
    //             "city_code": 131,
    //             "district": "",
    //             "province": "北京市",
    //             "street": "",
    //             "street_number": ""
    //         },
    //         "point": {
    //             "x": "116.40387397",
    //             "y": "39.91488908"
    //         }
    //     },
    //     "status": 0
    // }
    ....
} else {
    // 异常情况
    ....
}
....
```