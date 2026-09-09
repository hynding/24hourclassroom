<?php

namespace App\Enums;

enum GradeLevel: string
{
    case K2 = 'k-2';
    case G3_5 = '3-5';
    case G6_8 = '6-8';
    case G9_12 = '9-12';
    case HigherEd = 'higher-ed';
}
