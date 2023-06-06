<?php

use Queenshera\AdminPanel\Features;

return [
    'features' => [
        Features::updateProfilePhoto(),
        Features::twoFactorAuthentication(),
        Features::twoFactorAuthRecovery(),
        Features::accountDeletion(),
        Features::registration(),
        Features::emailVerification(),
        Features::resetPasswords(),
    ],
];
