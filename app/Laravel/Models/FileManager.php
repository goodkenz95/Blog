<?php

namespace App\Laravel\Models;

use Illuminate\Database\Eloquent\Model;
use App\Laravel\Traits\DateFormatterTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileManager extends Model
{
    use DateFormatterTrait,SoftDeletes;

	protected $table = "file_manager";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type','directory','filename','path','custom_filename','source'];
    
    protected $appends = ['new_directory'];

    public $timestamps = true;

    public function getNewDirectoryAttribute(){
        return str_replace(env("BLOB_STORAGE_URL"), env("CDN_STORAGE_URL"), $this->directory);
    }

}
