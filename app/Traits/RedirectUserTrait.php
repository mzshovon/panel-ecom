<?php

namespace App\Traits;

trait RedirectUserTrait
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            dd(true);
            return $this->redirectTo();
        }
        return route('home');
    }
}
