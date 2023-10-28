<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.user.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.user.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = UserService::getById($id);
        return view('pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.user.edit', compact('id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $isDeleted = UserService::deleteById($id);
            return $isDeleted ? redirect()->route('dashboard.user.index')->with('success', 'User deleted succesfully') : redirect()->back()->with('error','Failed to delete user');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete user ' . $e->getMessage());
        }
    }
}
