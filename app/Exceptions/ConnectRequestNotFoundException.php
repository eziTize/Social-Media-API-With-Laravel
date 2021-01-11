<?php

namespace App\Exceptions;

use Exceptions;

class ConnectRequestNotFoundException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json([
            'errors' => [
                'code' => 404,
                'title' => 'Connect Request Not Found',
                'detail' => 'Unable to locate the connect request with the given information.',
            ]
        ], 404);
    }
}