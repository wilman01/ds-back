<?php
namespace App\Enums;

enum Customer:string{
    case NOT_VERIFY = 'not_verify';
    case VERIFY = 'verify';
    case CONTACTED = 'contacted';
}
