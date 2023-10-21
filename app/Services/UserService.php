<?php
namespace App\Services;

use App\Models\User;

class UserService
{
    public static function getById(string $id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    public static function deleteById(string $id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }
}
