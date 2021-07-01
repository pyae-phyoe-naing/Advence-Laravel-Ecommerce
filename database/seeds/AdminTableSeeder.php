<?php

use App\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'=>'Pyae Phyoe Naing',
            'email'=>'pyaephyoenaing@gmail.com',
            'type'=>'admin',
            'mobile'=>'09777758089',
            'password'=>Hash::make('password'),
            'status'=>0,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
    }
}
