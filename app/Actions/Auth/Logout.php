<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;

class logout
{
    public function execute(Request $request): void
    {
        // Delete the current access token only (logout from this device/session)
        $request->user()->currentAccessToken()->delete();
    }
}
