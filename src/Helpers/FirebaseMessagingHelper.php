<?php

namespace Queenshera\AdminPanel\Helpers;

use Kreait\Firebase\Messaging\CloudMessage;

/**
 * This class is used to run Google Firebase functions
 */
class FirebaseMessagingHelper
{
    private function firebaseMessaging()
    {
        $factory = (new \Kreait\Firebase\Factory)->withServiceAccount(app_path() . '/Http/Firebase/adminsdk.json');
        $message = $factory->createMessaging();

        return $message;
    }

    public function subscribeToTopic($topic, $token)
    {
        return $this->firebaseMessaging()->subscribeToTopic($topic, $token);
    }

    public function unsubscribeFromTopic($topic, $token)
    {
        return $this->firebaseMessaging()->unsubscribeFromTopic($topic, $token);
    }

    public function unsubscribeFromAllTopics($token)
    {
        return $this->firebaseMessaging()->unsubscribeFromAllTopics($token);
    }

    public function getSubscriptions($token)
    {
        $appInstance = $this->firebaseMessaging()->getAppInstance($token);

        $subscriptions = $appInstance->topicSubscriptions();

        return $subscriptions;
    }

    public function sendToTopics($topic, $notification, $extraData)
    {
        $message = CloudMessage::fromArray([
            'topic' => $topic,
            'notification' => $notification,
            'data' => $extraData,
        ])->withHighestPossiblePriority();

        $this->firebaseMessaging()->send($message);
        return 1;
    }

    public function sendToSpecificDevice($deviceToken, $notification, $extraData)
    {
        $message = CloudMessage::fromArray([
            'token' => $deviceToken,
            'notification' => $notification,
            'data' => $extraData,
        ])->withHighestPossiblePriority();

        $this->firebaseMessaging()->send($message);
        return 1;
    }

    public function sendToMultipleDevices($deviceTokens, $notification, $extraData)
    {
        $message = CloudMessage::fromArray([
            'notification' => $notification,
            'data' => $extraData,
        ])->withHighestPossiblePriority();

        $this->firebaseMessaging()->sendMulticast($message, $deviceTokens);
        return 1;
    }

    public function validateTokens($deviceTokens)
    {
        $result = $this->firebaseMessaging()->validateRegistrationTokens($deviceTokens);

        return $result;
    }
}
