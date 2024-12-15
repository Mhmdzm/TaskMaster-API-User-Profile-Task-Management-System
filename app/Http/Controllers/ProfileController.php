<?php

namespace App\Http\Controllers;

use App\Http\Requests\profileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function store(profileRequest $request)
    {
        $profile = Profile::create($request->validated());
        return response()->json([
            'message' => 'create successfuly',
            'profile' => $profile
        ], 201);
    }
    function update(profileRequest $request, $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->update($request->validated());
        return response()->json($profile, 201);
    }
    function show($id)
    {
        $profile = Profile::where('user_id', $id)->firstOrFail();
        return response()->json($profile, 200);
    }
}
