<?php

namespace App\Laravel\Listeners;

use App\Laravel\Events\UserAction;
use App\Laravel\Models\UserDevice;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon;

class UserActivityListener implements ShouldQueue
{
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserAction  $event
     * @return void
     */
    public function handle(UserAction $event)
    {
        $user = $event->user;
        $user->last_activity = Carbon::now();
        if($user->type == "mentee" AND $user->is_approved == "pending"){
            $user->is_approved = "yes";
        }
        $user->save();

        if(in_array("update_device", $event->actions) OR in_array("register", $event->actions) OR in_array("login", $event->actions)) {

            $user = $event->user;
            if(!in_array("update_device", $event->actions)){
                $user->last_activity = Carbon::now();
                $user->last_login = Carbon::now();
                $user->save();
            }
            $request = $event->request;

            if($request->has('device_id') AND strlen($request->get('device_id') > 0)){

                $device = UserDevice::where('user_id', $user->id)->where('device_id',  $request->get('device_id'))->first();

                UserDevice::where('device_id', $request->get('device_id'))
                            ->where('user_id','<>',$user->id)
                            ->update(['is_login' => "0"]);
                            
                if(!$device){
                    $new_device = new UserDevice;
                    $new_device->user_id = $user->id;
                    $new_device->reg_id =  $request->get('device_reg_id') ? : "";
                    $new_device->device_id =  $request->get('device_id');
                    $new_device->device_name =  $request->get('device_name');
                    $new_device->device_model =  $request->get('device_model','');
                    $new_device->device_imei =  $request->get('device_imei','');
                    $new_device->os_version =  $request->get('os_version','');
                    $new_device->is_login = 1;
                    $new_device->save();
                }else{
                    $device->reg_id =  $request->get('device_reg_id') ? : "";
                    $device->device_name =  $request->get('device_name');
                    $device->device_model =  $request->get('device_model','');
                    $device->device_imei =  $request->get('device_imei','');
                    $device->os_version =  $request->get('os_version','');
                    $device->is_login = 1;
                    $device->save();
                }
            }
        }
    }
}
