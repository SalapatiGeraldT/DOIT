<?php
use Carbon\Carbon;

if(!function_exists('formatUpdatedAt')){
    function formatUpdatedAt($dateTime)
    {
        $updatedAt = Carbon::parse($dateTime);
        $now = Carbon::now();
    
        $diffInDays = $updatedAt->diffInDays($now);
        $diffInWeeks = $updatedAt->diffInWeeks($now);
        $diffInMonths = $updatedAt->diffInMonths($now);
        $diffInYears = $updatedAt->diffInYears($now);
    
        if ($diffInDays === 0) {
            return $updatedAt->format('h:i a');
        } elseif ($diffInDays === 1) {
            return 'yesterday';
        } elseif ($diffInWeeks < 1) {
            return $diffInDays . ' days ago';
        } elseif ($diffInMonths < 1) {
            return $diffInWeeks . ' weeks ago';
        } elseif ($diffInYears < 1) {
            return $diffInMonths . ' months ago';
        } else {
            return $diffInYears . ' years ago';
        }
    }
}

