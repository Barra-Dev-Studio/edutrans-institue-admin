<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\OwnedCourse;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\UserService;
use Maatwebsite\Excel\Facades\Excel;

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
        $stats = [
            'courses' => OwnedCourse::where('member_id', $id)->count(),
            'transactions' => Transaction::where('member_id', $id)->count(),
            'payment' => Transaction::where('member_id',$id)->where('status', 'SUCCEEDED')->sum('total_payment'),
        ];
        return view('pages.user.show', compact('user', 'stats'));
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

    public function export()
    {
        $filename = "users-" . Carbon::now()->format('d-m-Y') . ".xlsx";
        return Excel::download(new UsersExport, $filename);
    }
}
