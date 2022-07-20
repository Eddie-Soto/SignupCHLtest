<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Google\Cloud\Storage\StorageClient;
use League\Flysystem\Filesystem;
use Superbalist\Flysystem\GoogleStorage\GoogleStorageAdapter;

class GoogleStorageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Storage::extend('gcs', function($app, $confirg){

            $storageClient = new StorageClient([
                    'projectId' => $confirg['project_id'],
                    'keyFilePath' => $confirg['key_file'],
                ]);

            $bucket = $storageClient->bucket($confirg['bucket']);
            $adapter = new GoogleStorageAdapter($storageClient, $bucket);
            
            return new Filesystem($adapter);

         });
    }
}
