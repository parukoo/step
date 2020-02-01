<?php

namespace STEP\Policies;

use STEP\User;
use STEP\Step;
use Illuminate\Auth\Access\HandlesAuthorization;

class StepPolicy
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
     * @param  \STEP\User $user 現在ログインしているユーザー
     * @param  \STEP\Step $step 現在表示している投稿
     * @return mixed
     */
    public function edit(User $user, Step $step)
    {
        return $user->id == $step->user_id;
    }
}
