<?php

namespace Queenshera\AdminPanel\Helpers;

use Kreait\Firebase\Exception\RemoteConfigException;
use Kreait\Firebase\RemoteConfig;

/**
 * This class is used to run Google Firebase remote configuration values
 */
class FirebaseRemoteConfigHelper
{
    private static function configure()
    {
        $factory = (new \Kreait\Firebase\Factory)->withServiceAccount(app_path() . '/Http/Firebase/adminsdk.json');
        $auth = $factory->createRemoteConfig();

        return $auth;
    }

    /**
     * List all remote configuration elements
     *
     * @return RemoteConfig\Parameter[]
     * @throws RemoteConfigException
     */
    public static function getConfigValues()
    {
        $parameters = FirebaseRemoteConfigHelper::configure()->get()->parameters();

        $configParams = [];
        foreach ($parameters as $param) {
            $parameter['configName'] = $param->name();
            $parameter['defaultValue'] = $param->defaultValue()->toArray()['value'];
            $parameter['configDescription'] = $param->description();
            $configParams[] = $parameter;
        }

        return $configParams;
    }

    /**
     * Create new remote configuration element/s
     *
     * @param $configParameters
     * @return string
     * @throws RemoteConfigException
     */
    public static function createConfigValues($configParameters)
    {
        $oldParameters = FirebaseRemoteConfigHelper::configure()->get()->parameters();

        $configParams = [];
        foreach ($oldParameters as $param) {
            $parameter['configName'] = $param->name();
            $parameter['defaultValue'] = $param->defaultValue()->toArray()['value'];
            $parameter['configDescription'] = $param->description();
            $configParams[] = $parameter;
        }
        if (sizeof($configParams)) {
            $configParameters = array_merge($configParams, $configParameters);
        }

        $template = RemoteConfig\Template::new();

        foreach ($configParameters as $parameter) {
            $template = $template
                ->withParameter(RemoteConfig\Parameter::named($parameter['configName'])
                    ->withDefaultValue($parameter['defaultValue'])
                    ->withDescription($parameter['configDescription']));
        }

        try {
            return FirebaseRemoteConfigHelper::configure()->publish($template);
        } catch (RemoteConfigException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove existing remote configuration element/s
     *
     * @param $configElements
     * @return string
     * @throws RemoteConfigException
     */
    public static function removeConfigValues($configElements)
    {
        $oldParameters = FirebaseRemoteConfigHelper::configure()->get()->parameters();

        $configParams = [];
        foreach ($oldParameters as $param) {
            $parameter['configName'] = $param->name();
            $parameter['defaultValue'] = $param->defaultValue()->toArray()['value'];
            $parameter['configDescription'] = $param->description();
            $configParams[] = $parameter;
        }

        $template = RemoteConfig\Template::new();

        foreach ($configParams as $parameter) {
            $template = $template
                ->withParameter(RemoteConfig\Parameter::named($parameter['configName'])
                    ->withDefaultValue($parameter['defaultValue'])
                    ->withDescription($parameter['configDescription']));
        }

        foreach ($configElements as $element) {
            $template = $template
                ->withRemovedParameter($element);
        }

        try {
            return FirebaseRemoteConfigHelper::configure()->publish($template);
        } catch (RemoteConfigException $e) {
            return $e->getMessage();
        }
    }
}
