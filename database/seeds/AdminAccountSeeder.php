<?php

use App\Laravel\Models\User;
use Illuminate\Database\Seeder;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first_user = User::find(1);
        if($first_user){
            $input = ['username' => "admin", 'email' => "master_admin@domain.com",'password' => bcrypt('admin'),'name' => "Admin","type" => "super_user",'fb_id' => "1414327452115427",'description' => "admin account"];
            $first_user->fill($input);
            $first_user->save();
        }else{
            if(env('DB_CONNECTION','sqlsrv') != "sqlsrv"){
                User::create(
                    ['id'=> 1,'username' => "admin", 'email' => "master_admin@domain.com",'password' => bcrypt('admin'),'name' => "Admin","type" => "super_user",'fb_id' => "1414327452115427",'description' => "admin account"]
                );
            }else{
                DB::connection(env('MASTER_DB_CONNECTION','master_db'))->unprepared ('SET IDENTITY_INSERT [user] ON');
                DB::connection(env('MASTER_DB_CONNECTION','master_db'))->table('user')->insert(['id'=> 1,'username' => "admin", 'email' => "master_admin@domain.com",'password' => bcrypt('admin'),'name' => "Master Admin","type" => "super_user",'fb_id' => "1414327452115427",'description' => "admin account"]);
                DB::connection(env('MASTER_DB_CONNECTION','master_db'))->unprepared ('SET IDENTITY_INSERT [user] off');
            }
                
        }
    }
}
