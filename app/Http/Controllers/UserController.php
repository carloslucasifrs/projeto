<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        $user = Auth::user()->attributesToArray();

        return Inertia::render('User/Profile', ['user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function show($id): Response
    {
        $user = Auth::user()->attributesToArray();

        return Inertia::render('User/Profile', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Inertia\Response
     */
    public function edit(User $user): Response
    {
        $user = Auth::user()->attributesToArray();

        return Inertia::render('User/EditProfile', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateUserRequest   $request
     * @param  User  $user
     * @return \Inertia\Response
     */
    public function update(UpdateUserRequest $request, $id): RedirectResponse
    {
        Auth::user()->update($request->validated());

        return Redirect::route('profile');

        // return Inertia::render('User/Profile', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function destroy($id)
    {
        // TODO: implementar destroy user
    }
}
