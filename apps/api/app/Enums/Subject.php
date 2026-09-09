<?php

namespace App\Enums;

enum Subject: string
{
    case Math = 'math';
    case Science = 'science';
    case EnglishLanguageArts = 'english-language-arts';
    case SocialStudies = 'social-studies';
    case Art = 'art';
    case Music = 'music';
    case PhysicalEducation = 'pe';
    case WorldLanguages = 'world-languages';
    case ComputerScience = 'computer-science';
    case SpecialEducation = 'special-education';
    case Other = 'other';
}
