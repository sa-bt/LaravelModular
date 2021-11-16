<?php

if (! function_exists('newFeedback')) {
    function newFeedback($type = 'success', $message = 'عملیات با موفقیت انجام شد.')
    {
        $session   = session()->has('feedback') ? session()->get('feedback') : [];
        $session[] = ['type' => $type, 'message' => $message];
        session()->flash('feedback', $session);
    }
}
