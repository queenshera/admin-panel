<?php

namespace Queenshera\AdminPanel;

class Features
{
    public static function enabled(string $feature)
    {
        return in_array($feature, config('adminPanel.features'));
    }

    public static function updateProfilePhoto()
    {
        return 'update-profile-photo';
    }

    public static function twoFactorAuthentication()
    {
        return 'two-factor-authentication';
    }

    public static function twoFactorAuthRecovery()
    {
        return 'two-factor-auth-recovery';
    }

    public static function accountDeletion()
    {
        return 'account-deletion';
    }

    public static function registration()
    {
        return 'registration';
    }

    public static function emailVerification()
    {
        return 'email-verification';
    }

    public static function resetPasswords()
    {
        return 'reset-password';
    }
}
