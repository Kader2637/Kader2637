<?php

namespace App\Http\Controllers;

use App\Models\ForgotPassword;
use App\Http\Requests\StoreForgotPasswordRequest;
use App\Http\Requests\UpdateForgotPasswordRequest;

class ForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreForgotPasswordRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ForgotPassword $forgotPassword)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ForgotPassword $forgotPassword)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateForgotPasswordRequest $request, ForgotPassword $forgotPassword)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ForgotPassword $forgotPassword)
    {
        //
    }
}
