<?php

namespace App\Enums;

enum Platforms: string {
    case DESKTOP = 'desktop';
    case WEB_CLIENT = 'web_client';
    case WEB_ADMIN = 'web_admin';
}
