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
    case AssignedForDelivery = 'assigned for delivery';
    case OutForDelivery = 'out for delivery';
    case Returned = 'returned';
    case Cancelled = 'cancelled';
    case WithHold = 'with hold';
    case Delivered = 'delivered';
    case OutOfStock = 'out of stock';
    case Waiting = 'waiting';
    case InTransit = 'in transit';
    case AtSort = 'at sort';
    case Confirmed = 'confirmed';
}
