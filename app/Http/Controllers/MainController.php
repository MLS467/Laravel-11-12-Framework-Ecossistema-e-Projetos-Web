<?php

namespace App\Http\Controllers;


class MainController
{

    public function post($user_id, $post_id = null)
    {
        echo "User id ->> $user_id e Post ID ->> $post_id";
    }
}