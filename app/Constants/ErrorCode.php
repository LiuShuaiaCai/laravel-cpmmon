<?php

namespace App\Constants;


class ErrorCode
{
    /**
     * @Message("Server Error！")
     */
    public const SERVER_ERROR = 500;

    /**
     * @Message("params is error")
     */
    public const PARAMS_ERROR = 400;

    /**
     * @Message("No permission operation")
     */
    public const NOT_PERMISSION = 403;


    /**
     * 自定义错误码
     *
     * 规则：模块代码（2位） 功能代码（2位）具体错误码（4位）
     * 总长度8位：例如10010001，10 01 0001（10:模块代码（10-99），01:功能代码(01-99)，0001:具体错误码（0001-9999））
     */

    /**
     * @Message("request data does not exist")
     */
    public const CUSTOM_ERROR_DATA_NOT_EXISTS = 10100001;


    // 用户信息
    public const CUSTOM_ERROR_EMAIL_NOT_REGISTER = 20010001;    // 邮箱未注册
    public const CUSTOM_ERROR_USER_PASSWORD_ERROR = 20010002;    // 用户密码错误


    // 错误码对应的信息
    public const CODE_MESSAGE = [
        self::SERVER_ERROR                     => 'server error',
        self::PARAMS_ERROR                     => 'params is error',
        self::NOT_PERMISSION                   => 'no permission operation',
        self::CUSTOM_ERROR_DATA_NOT_EXISTS     => 'request data does not exist',
        self::CUSTOM_ERROR_EMAIL_NOT_REGISTER  => 'email not register',
        self::CUSTOM_ERROR_USER_PASSWORD_ERROR => 'password error',
    ];
}
