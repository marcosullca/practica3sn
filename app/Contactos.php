<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contactos extends Model
{
    protected $fillable=['nombres','apellidos','correo','telefono','preview_url'];

    // public function getUrlAttribute()
    // {
    //     return $this->getFileUrl($this->attributes['file']);
    // }

    // private function getFileUrl($key) {
    //     $s3 = Storage::disk('s3');
    //     $client = $s3->getDriver()->getAdapter()->getClient();
    //     $bucket = Config::get('filesystems.disks.s3.bucket');

    //     $command = $client->getCommand('GetObject', [
    //         'Bucket' => $bucket,
    //         'Key' => $key
    //     ]);

    //     $request = $client->createPresignedRequest($command, '+20 minutes');

    //     return (string) $request->getUri();
    // }
}
