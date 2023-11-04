<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        return view('pages.member.index');
    }

    public function transaction()
    {
        $memberId = Auth()->user()->id;
        return view('pages.member.transaction', compact('memberId'));
    }
}
