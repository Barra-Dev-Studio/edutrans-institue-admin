<?php

namespace App\Services;

use App\Models\OwnedBook;

class OwnedBookService
{
    public static function getById($id)
    {
        return OwnedBook::where('id', $id)->where('member_id', auth()->id())->with('book')->first();
    }
}
