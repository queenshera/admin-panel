<?php

namespace Queenshera\AdminPanel\Helpers;

use Kreait\Firebase\Messaging\CloudMessage;

/**
 * This class is used to run Google Firebase functions
 */
class FirebaseAuthHelper
{
    private function firebaseAuthentication()
    {
        $factory = (new \Kreait\Firebase\Factory)->withServiceAccount(app_path() . '/Http/Firebase/adminsdk.json');
        $auth = $factory->createAuth();

        return $auth;
    }

    public function signInAnonymously()
    {
        return $this->firebaseAuthentication()->signInAnonymously();
    }

    public function signInWithEmailAndPassword($email, $password)
    {
        return $this->firebaseAuthentication()->signInWithEmailAndPassword($email, $password);
    }

    public function signInWithRefreshToken($refreshToken)
    {
        return $this->firebaseAuthentication()->signInWithRefreshToken($refreshToken);
    }

    public function signInWithUid($uid)
    {
        return $this->firebaseAuthentication()->signInAsUser($uid);
    }


}
