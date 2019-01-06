<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class PostPolicy
 * 权限类
 * @package App\Policie
 */
class PostPolicy {
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {

    }

    public function update(User $user, Post $post) {
        return $user->id == $post->user_id;
    }

    public function delete(User $user, Post $post) {
        return $user->id == $post->user_id;
    }
}
