<?php

namespace Queenshera\AdminPanel\Helpers;

use Kreait\Firebase\Messaging\CloudMessage;

/**
 * This class is used to run Google Firebase authentication
 */
class FirebaseAuthHelper
{
    private function firebaseAuthentication()
    {
        $factory = (new \Kreait\Firebase\Factory)->withServiceAccount(app_path() . '/Http/Firebase/adminsdk.json');
        $auth = $factory->createAuth();

        return $auth;
    }

    /**
     * Signin to firebase anonymously
     *
     * @return \Kreait\Firebase\Auth\SignInResult
     */
    public function signInAnonymously()
    {
        return $this->firebaseAuthentication()->signInAnonymously();
    }

    /**
     * Signin to firebase using existing email ID and password
     *
     * @param $email
     * @param $password
     * @return \Kreait\Firebase\Auth\SignInResult
     */
    public function signInWithEmailAndPassword($email, $password)
    {
        return $this->firebaseAuthentication()->signInWithEmailAndPassword($email, $password);
    }

    /**
     * This function is used to signin firebase with refresh token provided by normal signin
     *
     * @param $refreshToken
     * @return \Kreait\Firebase\Auth\SignInResult
     */
    public function signInWithRefreshToken($refreshToken)
    {
        return $this->firebaseAuthentication()->signInWithRefreshToken($refreshToken);
    }

    /**
     * Thisn function is used to signin firebase using uid
     *
     * @param $uid
     * @return \Kreait\Firebase\Auth\SignInResult
     */
    public function signInWithUid($uid)
    {
        return $this->firebaseAuthentication()->signInAsUser($uid);
    }


}
