<?php

declare(strict_types=1);

namespace App\Enums;

enum StatusEnum: string {
    case Active = 'active';
    case Deactive = 'deactive';
    case Rejected = 'rejected';
    case Declined = 'declined';
    case Pending = 'pending';
    case Freeze = 'freeze';
    case Paused = 'paused';
    case AssignedForDelivery = 'assigned_for_delivery';
    case OutForDelivery = 'out_for_delivery';
    case Returned = 'returned';
    case Cancelled = 'cancelled';
}
