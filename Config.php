<?php
defined('INDEX_AUTH') OR die('Direct access not allowed!');

use SLiMS\Config as SLiMSConfig;

class WaConfig
{
    const PREFIX = 'plugins.whatsapp_notifier';

    public static function set(string $key, $value): bool
    {
        $name = self::PREFIX . '.' . $key;

        if (is_array($value) || is_object($value)) {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        } elseif (is_bool($value)) {
            $value = $value ? '1' : '0';
        } else {
            $value = (string) $value;
        }

        return SLiMSConfig::createOrUpdate($name, $value);
    }

    public static function get(string $key, $default = null)
    {
        $name = self::PREFIX . '.' . $key;

        $cfg = SLiMSConfig::getInstance();
        if (!$cfg) {
            return $default;
        }

        $value = $cfg->get($name, null);
        if ($value === null) {
            return $default;
        }

        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $decoded;
        }

        if ($value === '1') return true;
        if ($value === '0') return false;

        if (is_numeric($value)) {
            return (int) $value;
        }

        return $value;
    }
}
