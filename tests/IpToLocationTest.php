<?php
/**
 * 根据IP返回位置信息测试
 * User: chocoboxxf
 * Date: 16/5/23
 * Time: 下午5:58
 */
namespace chocoboxxf\Baidu\Map\Tests;

use Yii;

class IpToLocationTest extends \PHPUnit_Framework_TestCase
{
    public function testNormalIp()
    {
        $map = Yii::createObject([
            'class' => 'chocoboxxf\Baidu\Map\Map',
            'ak' => 'ny8z4cIbNaWMDIanPXwnfjB1QhIaSPHO',
            'sk' => 'DGV6nXBg2hUoRpIVggXAqflLRlaHEcLx',
        ]);
        var_dump($map->ipToLocation('220.181.57.217'));
    }

    public function testNormalIpBd09ll()
    {
        $map = Yii::createObject([
            'class' => 'chocoboxxf\Baidu\Map\Map',
            'ak' => 'ny8z4cIbNaWMDIanPXwnfjB1QhIaSPHO',
            'sk' => 'DGV6nXBg2hUoRpIVggXAqflLRlaHEcLx',
        ]);
        echo json_encode($map->ipToLocation('220.181.57.217', 'bd09ll'));
    }

    public function testInternalIp()
    {
        $map = Yii::createObject([
            'class' => 'chocoboxxf\Baidu\Map\Map',
            'ak' => 'ny8z4cIbNaWMDIanPXwnfjB1QhIaSPHO',
            'sk' => 'DGV6nXBg2hUoRpIVggXAqflLRlaHEcLx',
        ]);
        var_dump($map->ipToLocation('127.0.0.1', 'bd09ll'));
    }

    public function testWrongIp()
    {
        $map = Yii::createObject([
            'class' => 'chocoboxxf\Baidu\Map\Map',
            'ak' => 'ny8z4cIbNaWMDIanPXwnfjB1QhIaSPHO',
            'sk' => 'DGV6nXBg2hUoRpIVggXAqflLRlaHEcLx',
        ]);
        var_dump($map->ipToLocation('999.999.999.999', 'bd09ll'));
    }
}
