<?php

use Illuminate\Database\Seeder;
use App\Fault;

class FaultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $address = [
            '文公','梁庄','马村','地调','韩王','清化','罩杯','太子庄','怀庆','北黑','春林',
            '保封','岭南','新河'
        ];
        $ranges = [
            '被授时系统设备','时钟设备','测试对象'
        ];
        $analyes = [
            '时间同步在线监测服务器响应异常',
            '时钟电源故障',
            '装置发送上电或者复位,正在初始化',
            '被检测对象同步准确的异常',
            '卫星接收模块异常',
            '天线损坏',
            '被检测对象服务器响应异常',
            '测试服务器异常',
            '时源异常',
            '授时正常',
            '信号异常正在授时',
            '对时信号源或链路故障',
            '对时信号异常',
            '设备未对时'
        ];
        $equipment = [
                'name'=>'河南焦作%s变电站',
                'range'=>'%s',
                'analyse'=>'%s',
                'status'=>rand(1,2),
                'created_at'=>now(),
                'updated_at'=>now()
        ];

        foreach($address as $key=>$value) {
            $equipment['name'] = sprintf($equipment['name'],$value);
            $equipment['range'] = $ranges[random_int(0,2)];
            $equipment['status'] = random_int(1,3);
            $equipment['analyse'] = $analyes[$key];
            $equipment['created_at'] = now();
            $equipment['updated_at'] = now();

            Fault::create($equipment);
        }

    }
}
