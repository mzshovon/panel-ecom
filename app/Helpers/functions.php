<?php

use App\Models\Category;
use App\Repo\CategoryRepo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

if (!function_exists('customPaginate')) {
    /**
     * @param mixed $items
     * @param int $perPage
     * @param null $page
     *
     * @return mixed
     */
    function customPaginate($items, $perPage = 5, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath()
        ]);
    }
}

if (!function_exists('getUserInfo')) {
    /**
     * @return mixed
     */
    function getUserInfo()
    {
        return auth()->user();
    }
}

if (!function_exists('storeOrUpdateImage')) {
    /**
     * @return mixed
     */
    function storeOrUpdateImage($filePath, $file, $fileNamePrefix, $unlinkExisting = true)
    {
        if(!File::exists($filePath)) {
            mkdir($filePath, 0777, true);
        }
        $fileName = "$fileNamePrefix";
        $dirPath = $filePath . $fileName;
        if($unlinkExisting) {
            if (File::exists($dirPath)) {
                File::deleteDirectory($dirPath);
            }
        }
        file_put_contents($dirPath, file_get_contents($file));
        return $dirPath;
    }
}

if (!function_exists('sendMailWithTemplate')) {
    /**
     * @return mixed
     */
    function sendMailWithTemplate($data, $template, $to, $cc = null)
    {
        $subject = $data['subject'];
        if(array_key_exists("message", $data)) {
            $message = $data["message"];
            unset($data['message']);
            $data['mailMessage'] = $message;
        }
        Mail::send($template, $data, function ($mail) use ($subject, $to, $cc) {
            $mail->to($to);
            if($cc){
                $mail->cc($cc);
            }
            $mail->subject($subject);
        });
        return true;
    }
}

if (!function_exists('setStartEndDayForFiltering')) {
    /**
     * Use if your filtering logic is:
     * If user doesn't select from and to, then it returns null
     *
     * @param $from
     * @param $to
     * @return string[]
     */
    function setStartEndDayForFiltering($from, $to)
    {
        if ($from && $to) {
            $from = date($from) . " 00:00:00";
            $to = date($to) . " 23:59:59";
        }
        return [$from, $to];
    }
}

if (!function_exists('getCategoryList')) {
    /**
     * Use if your filtering logic is:
     * If user doesn't select from and to, then it returns null
     *
     * @return array
     */
    function getCategoryList()
    {
        $categoryRepo = new CategoryRepo(new Category());
        return $categoryRepo->get();
    }
}

if (!function_exists('numberToOrdinal')) {
    /**
     * Use if your filtering logic is:
     * If user doesn't select from and to, then it returns null
     *
     * @return string
     */
    function numberToOrdinal($number) {
        $ordinals = [
            1 => 'first',
            2 => 'second',
            3 => 'third',
            4 => 'fourth',
            5 => 'fifth',
            6 => 'sixth',
            7 => 'seventh',
            8 => 'eighth',
            9 => 'ninth',
            10 => 'tenth'
            // Add more ordinals as needed
        ];

        return isset($ordinals[$number]) ? $ordinals[$number] : "{$number}th";
    }

}

if (!function_exists('cartCount')) {
    /**
     * Use if your filtering logic is:
     * If user doesn't select from and to, then it returns null
     *
     * @return int
     */
    function cartCount() {
        $cart = Session::get('cart', []);
        $count = 0;
        if(!empty($cart)) {
            foreach ($cart as $key => $value) {
                $count += $value['quantity'];
            }
        }
        return $count;
    }
}
