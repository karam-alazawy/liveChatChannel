<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Events\liveChatEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new user.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */

    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        event(new liveChatEvent("$request->name","$request->message"));

        return response()->json(['message' => 'Message sent successfully'], 200);

    }

}
