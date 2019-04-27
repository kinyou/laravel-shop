<?php

use Illuminate\Database\Seeder;
use App\Runtime;

class RuntimeTableSeeder extends Seeder
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

        $ip = '45.192.170.%d';

        $equipment = [
            'name'=>'河南焦作%s变电站',
            'ip'=>$ip,
            'status'=>rand(1,2),
            'cpu'=>'%d',
            'mem'=>'%d',
            'created_at'=>now(),
            'updated_at'=>now()
        ];


        foreach($address as $key=>$value) {
            $equipments = [];
            $equipments['name'] = sprintf($equipment['name'],$value);
            $equipments['ip'] = sprintf($equipment['ip'],random_int(10,255));
            $equipments['status'] = random_int(1,2);
            $equipments['cpu'] = sprintf($equipment['cpu'],random_int(10,99));
            $equipments['mem'] = sprintf($equipment['mem'],random_int(10,99));
            $equipments['created_at'] = now();
            $equipments['updated_at'] = now();

            Runtime::create($equipments);
        }

    }
}
