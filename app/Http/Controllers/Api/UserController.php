<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests\Api\BaseRequest;
use App\Http\Requests\Api\Users\CreateUserRequest;
use App\Http\Requests\Api\Users\UpdateUserRequest;
use App\Models\Api\Users\User;


class UserController extends ApiController
{
    /**
     * @SWG\Post(
     *     path="/user/create",
     *     summary="створити користувача",
     *     tags={"App\Models\Base\Users\User"},
     *
     *
     *     @SWG\Parameter(
     *         name="first_name",
     *         in="query",
     *         type="string",
     *         description="first_name",
     *         required=true
     *     ),
     *
     *
     *     @SWG\Parameter(
     *         name="last_name",
     *         in="query",
     *         type="string",
     *         description="last_name",
     *         required=true
     *     ),
     *
     *     @SWG\Parameter(
     *         name="email",
     *         in="query",
     *         type="string",
     *         description="email",
     *         required=true
     *     ),
     *
     *     @SWG\Parameter(
     *         name="password",
     *         in="query",
     *         type="string",
     *         description="password",
     *         required=true
     *     ),
     *
     *     @SWG\Response(
     *         response=200,
     *         description="",
     *     @SWG\Schema(ref="#/definitions/App\Models\Base\Users\User"),
     *     ),
     * )
     */
    public function createUser(CreateUserRequest $request)
    {
        $dataUser = $request->only([
            'first_name',
            'last_name',
            'email',
            'password',
        ]);
        $user = User::create($dataUser);
        $this->setData($user);

        return $this->getResponse();
    }

    /**
     * @SWG\Post(
     *     path="/user/update",
     *     summary="обновити дані користувача",
     *     tags={"App\Models\Base\Users\User"},
     *
     *     @SWG\Parameter(
     *         name="id",
     *         in="query",
     *         type="string",
     *         description="id користувача",
     *         required=true
     *     ),
     *
     *     @SWG\Parameter(
     *         name="first_name",
     *         in="query",
     *         type="string",
     *         description="first_name",
     *         required=true
     *     ),
     *
     *
     *     @SWG\Parameter(
     *         name="last_name",
     *         in="query",
     *         type="string",
     *         description="last_name",
     *         required=true
     *     ),
     *
     *     @SWG\Parameter(
     *         name="email",
     *         in="query",
     *         type="string",
     *         description="email",
     *         required=true
     *     ),
     *
     *     @SWG\Response(
     *         response=200,
     *         description="об'єктів Project",
     *     @SWG\Schema(ref="#/definitions/App\Models\Base\Users\User"),
     *     ),
     * )
     */
    public function updateUser(UpdateUserRequest $request)
    {
        $dataUser = $request->only([
            'id',
            'first_name',
            'last_name',
            'email',
            'password',
        ]);

        User::find($dataUser['id'])->update($dataUser);
        $user = User::find($dataUser['id']);
        $this->setData($user);

        return $this->getResponse();
    }

    /**
     * @SWG\Get(
     *     path="/user/search/{id}",
     *     summary="дістати одиного користувача по id",
     *     tags={"App\Models\Base\Users\User"},
     *
     *     @SWG\Response(
     *         response=200,
     *         description="",
     *     @SWG\Schema(ref="#/definitions/App\Models\Base\Users\User"),
     *     ),
     * )
     */
    public function getUser($userId)
    {
        $user = User::findOrFail($userId);
        $this->setData($user);

        return $this->getResponse();
    }


    /**
     * @SWG\Get(
     *     path="/user/all",
     *     summary="дістати всіх користувачів",
     *     tags={"App\Models\Base\Users\User"},
     *
     *     @SWG\Response(
     *          response="200",
     *          description="масив об'єктів User",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/App\Models\Base\Users\User")
     *          ),
     *     ),
     * )
     */
    public function getUsers(BaseRequest $request)
    {
        $users = User::all();
        $this->setData($users);

        return $this->getResponse();
    }


}
