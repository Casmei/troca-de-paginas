<?php

namespace App\Enums;

enum ConservationStateEnum: string
{
    const New = 'new';
    const Excellent = 'excellent';
    const Good = 'good';
    const Regular = 'regular';
    const Worn = 'worn';
    const Damaged = 'damaged';
    const Unusable = 'unusable';
}
