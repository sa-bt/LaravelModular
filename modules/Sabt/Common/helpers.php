<?php
function newFeedback($type, $message)
{
    $session   = session()->has('feedback') ? session()->get('feedback') : [];
    $session[] = ['type' => $type, 'message' => $message];
    session()->flash('feedback', $session);
}
