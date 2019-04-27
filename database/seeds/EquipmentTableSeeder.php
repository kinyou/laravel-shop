<?php

use Illuminate\Database\Seeder;
use App\Equipment;

class EquipmentTableSeeder extends Seeder
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
        $equipment = [
                'name'=>'河南焦作%s变电站',
                'oem'=>'上海电力设备生产%d厂',
                'status'=>rand(1,2),
        ];

        foreach($address as $key=>$value) {
            $equipments = [];
            $equipments['name'] = sprintf($equipment['name'],$value);
            $equipments['oem'] = sprintf($equipment['oem'],random_int(1,7));
            $equipments['status'] = random_int(1,2);
            $equipments['created_at'] = now();
            $equipments['updated_at'] = now();

            Equipment::create($equipments);
        }

    }
}
