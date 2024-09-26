<?php

namespace App;

enum TaskPriority: string
{
    case low = 'low';
    case medium = 'medium';
    case high = 'high';
}
