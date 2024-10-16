<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
        
    // }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
        
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validator = User::validateUserData($request->all());

        // If validate fails, return error
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Hash password
        $requestData = $request->all();
        $requestData['password'] = Hash::make($request->password);

        // Create user
        $user = User::create($requestData);
        
        return response()->json(['message' => 'User created successfully', 'user' => $user], 201); 
    }

    /**
     * Display the specified resource.
     */
    // public function show(User $user)
    // {
        
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(User $user)
    // {
        
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, User $user)
    // {
        
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(User $user)
    // {
        
    // }
}
