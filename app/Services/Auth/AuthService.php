<?php

namespace App\Services\Auth;

use App\Services\Auth\Contracts\AuthContract;
use App\Services\Auth\Exceptions\AuthException;
use App\Services\Auth\Traits\Api;
use App\Services\Auth\Traits\AdminApi;
use App\Services\Auth\Traits\Web;
use Illuminate\Http\Request;
//тут повина була бути авторизація але задачі такої не було і мені впадло стало неї робити коли в ній немає толку
class AuthService implements AuthContract
{
    use Web;
    use Api;

    const WEB = 'web';
    const API = 'api';

    private $drivers = [
        self::WEB,
        self::API,
    ];

    public function login(Request $request, string $driver)
    {
        switch ($driver) {

            case self::API:
                return $this->apiLogin($request);
                break;

            case self::WEB:
                return $this->apiLogin($request);
                break;
        }
    }

    public function register(Request $request, string $driver)
    {
        switch ($driver) {
            case self::WEB:
                return $this->webRegister($request);
                break;
            case self::API:
                return $this->apiRegister($request);
                break;
        }
    }


    public function logout(string $driver)
    {
        switch ($driver) {
            case self::WEB:
                return $this->webLogout();
                break;
            case self::API:
                return $this->apiLogout();
                break;
        }
    }


}
