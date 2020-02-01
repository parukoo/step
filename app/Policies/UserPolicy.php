<?php

namespace STEP\Policies;

use STEP\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * 編集と削除の認可を判断する。
     *
     * @param  \STEP\User $user  現在ログインしているユーザー
     * @param  \STEP\User $model 現在表示しているプロフィールページのユーザー
     * @return mixed
     */
    public function edit(User $user, User $model)
    {
        return $user->id == $model->id;
    }
}
