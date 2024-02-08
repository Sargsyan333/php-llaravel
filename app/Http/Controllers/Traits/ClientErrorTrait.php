<?php


namespace App\Http\Controllers\Traits;

use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

trait ClientErrorTrait
{
    protected final function error(Exception $exception, $message = 'Oops, something went wrong')
    {
        $error = ['userMessage' =>  $message];
        $debug = [];
        if(App::environment('local')) {
            $debug = [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'trace' => $exception->getTraceAsString()
            ];
            Log::debug(print_r($debug,1));
        }

        return response()->json(['data' => array_merge($error, $debug)], 500);
    }
}