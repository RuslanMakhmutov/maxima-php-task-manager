<?php

if (!function_exists('is_auth')) {
    function is_auth(): bool
    {
        return isset($_SESSION['user_id']);
    }
}
