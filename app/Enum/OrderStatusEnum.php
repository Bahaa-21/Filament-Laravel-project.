<?php

namespace App\Enum;

enum OrderStatusEnum: string
{
    const PENDING = 'pending';

    const PROCESSING = 'processing';

    const COMPLETED = 'completed';

    const DECLINED = 'declined';
}
