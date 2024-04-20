<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VoucherService;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.voucher.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.voucher.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $voucher = VoucherService::findOrFail($id);
        $rules = json_decode($voucher->rules);
        $showRules = [];

        foreach ($rules as $rule => $value) {
            if (is_array($value)) {
                $newValue = collect($value)->map(function ($val) {
                    return $val->name;
                })->toArray();
                $newValue = implode(',', $newValue);
                $showRules[$rule] = $newValue;
            } else {
                $showRules[$rule] = $value;
            }
        }
        
        return view('pages.voucher.show', compact('voucher', 'showRules'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $voucher = VoucherService::findOrFail($id);

        return view('pages.voucher.edit', compact('voucher'));
    }

   /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $voucher = VoucherService::findOrFail($id);
        $isDeleted = VoucherService::deleteById($id);
        return $isDeleted
            ? redirect()->route('dashboard.voucher.index')->with('success', 'Voucher has been deleted')
            : redirect()->back()->with('error', 'Failed to delete voucher');

    }
}
