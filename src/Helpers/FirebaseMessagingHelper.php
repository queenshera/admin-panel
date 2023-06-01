<?php

namespace Queenshera\AdminPanel\Helpers;

use Kreait\Firebase\Messaging\CloudMessage;

/**
 * This class is used to run Google Firebase messaging
 */
class FirebaseMessagingHelper
{
    private static function createMessage()
    {
        $factory = (new \Kreait\Firebase\Factory)->withServiceAccount(app_path() . '/Http/Firebase/adminsdk.json');
        $message = $factory->createMessaging();

        return $message;
    }

    /**
     * Subscribe to specific topic to receive notification messages
     *
     * @param $topic
     * @param $tokens
     * @return \string[][]
     */
    public static function subscribeToTopic($topic, $tokens)
    {
        return FirebaseMessagingHelper::createMessage()->subscribeToTopic($topic, $tokens);
    }

    /**
     * Unsubscribe from specific topic
     *
     * @param $topic
     * @param $tokens
     * @return \string[][]
     */
    public static function unsubscribeFromTopic($topic, $tokens)
    {
        return FirebaseMessagingHelper::createMessage()->unsubscribeFromTopic($topic, $tokens);
    }

    /**
     * Unsubscribe all registered topics
     *
     * @param $tokens
     * @return \string[][]
     */
    public static function unsubscribeFromAllTopics($tokens)
    {
        return FirebaseMessagingHelper::createMessage()->unsubscribeFromAllTopics($tokens);
    }

    /**
     * Get list of all subscription by given token
     *
     * @param $token
     * @return \Kreait\Firebase\Messaging\TopicSubscriptions
     * @throws \Kreait\Firebase\Exception\MessagingException
     */
    public static function getSubscriptions($token)
    {
        $appInstance = FirebaseMessagingHelper::createMessage()->getAppInstance($token);

        $subscriptions = $appInstance->topicSubscriptions();

        return $subscriptions;
    }

    /**
     * Send notification message to specific topic
     *
     * @param $topic
     * @param $notification
     * @param $extraData
     * @return bool
     * @throws \Kreait\Firebase\Exception\FirebaseException
     * @throws \Kreait\Firebase\Exception\MessagingException
     */
    public static function sendToTopics($topic, $notification, $extraData)
    {
        $message = CloudMessage::fromArray([
            'topic' => $topic,
            'notification' => $notification,
            'data' => $extraData,
        ])->withHighestPossiblePriority();

        FirebaseMessagingHelper::createMessage()->send($message);
        return true;
    }

    /**
     * Send notification message to specific device token
     *
     * @param $deviceToken
     * @param $notification
     * @param $extraData
     * @return bool
     * @throws \Kreait\Firebase\Exception\FirebaseException
     * @throws \Kreait\Firebase\Exception\MessagingException
     */
    public static function sendToSpecificDevice($deviceToken, $notification, $extraData)
    {
        $message = CloudMessage::fromArray([
            'token' => $deviceToken,
            'notification' => $notification,
            'data' => $extraData,
        ])->withHighestPossiblePriority();

        FirebaseMessagingHelper::createMessage()->send($message);
        return true;
    }

    /**
     * Send notification message to multiple devices
     *
     * @param $deviceTokens
     * @param $notification
     * @param $extraData
     * @return bool
     * @throws \Kreait\Firebase\Exception\FirebaseException
     * @throws \Kreait\Firebase\Exception\MessagingException
     */
    public static function sendToMultipleDevices($deviceTokens, $notification, $extraData)
    {
        $message = CloudMessage::fromArray([
            'notification' => $notification,
            'data' => $extraData,
        ])->withHighestPossiblePriority();

        FirebaseMessagingHelper::createMessage()->sendMulticast($message, $deviceTokens);
        return true;
    }

    /**
     * Validate firebase registration tokens
     *
     * @param $deviceTokens
     * @return array
     * @throws \Kreait\Firebase\Exception\FirebaseException
     * @throws \Kreait\Firebase\Exception\MessagingException
     */
    public static function validateTokens($deviceTokens)
    {
        $result = FirebaseMessagingHelper::createMessage()->validateRegistrationTokens($deviceTokens);

        return $result;
    }
}
