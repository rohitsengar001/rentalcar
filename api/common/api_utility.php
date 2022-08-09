<?php

namespace api\common;

class api_utility
{

    /**
     * @param $success
     * @param $status
     * @param $message
     * @param array $extra
     * @return array
     */
    protected function msg($success, $status, $message, array $extra = []): array
    {
        return array_merge(["success" => $success, "status" => $status, "message" => $message], $extra);
    }

    /**
     * @param $file_name
     * @return bool
     */
    protected function filter_file($file_name): bool
    {
        $file_stored = ['jpg', 'png', 'jpeg'];
        $split_file = explode('.', $file_name);
        $check_extension = strtolower(end($split_file));
        if (in_array($check_extension, $file_stored))
            return true;
        return false;
    }

    /**
     * @param $token
     * @return bool
     */
    protected function filter_token($token): bool
    {
        return $token = 'valid-user';
    }
}