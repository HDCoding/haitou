<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Locked achievement sync
    |--------------------------------------------------------------------------
    |
    | Controls the behavior of how locked achievements will be handled.
    |
    | Achievements are only stored on the achievement_progress table whenever
    | they are made progress or unlocked. Therefore, by default there is no
    | "locked achievement" storage.
    |
    | When set to FALSE, this will not change how the relationship works.
    | achievements() on the Achiever trait WILL NOT RETURN LOCKED ACHIEVEMENTS,
    | only returning records on the achievement_progress table. The locked()
    | method will act as a simple query fetching all records that exist in
    | achievement_details and do not have equivalent records on
    | achievement_progress.
    |
    | When set to TRUE, any calls to the achievements() relationship will first
    | fetch locked achievements and then add them to the achievement_progress
    | table with progress 0. Therefore, the achievements() relationship WILL
    | RETURN LOCKED ACHIEVEMENTS, and the locked() method will act as a derived
    | query from achievements().
    |
    */
    'locked_sync' => true
];
