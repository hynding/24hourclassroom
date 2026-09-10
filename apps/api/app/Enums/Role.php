<?php

namespace App\Enums;

enum Role: string
{
    case Teacher = 'teacher';
    case Student = 'student';
    case Admin = 'admin';
}
