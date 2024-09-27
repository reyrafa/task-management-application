<?php

namespace App;

enum Status: string
{
    case pending = 'pending';
    case in_progress = 'in_progress';
    case completed = 'completed';


}
