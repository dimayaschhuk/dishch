<?php
/**
 * Created by PhpStorm.
 * User: edell
 * Date: 01.09.2018
 * Time: 18:16
 */

namespace App\Services\Auth\Contracts;

use Illuminate\Http\Request;

interface AuthContract
{
    public function login(Request $request, string $driver);

    public function logout(string $driver);
}
