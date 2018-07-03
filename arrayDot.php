<?php

if (!function_exists('get_array_dot')) {

    /**
     * Get array with dot notation
     * @param array $array
     * @param string $key
     * @param string $originalKey
     * @return mixed
     * @throws Exception
     */
    function get_array_dot(array &$array, string $key, string $originalKey = null)
    {
        // Original key
        if (is_null($originalKey)) {
            $originalKey = $key;
        }

        // Explode key
        $keys      = array_map('trim', explode('.', $key));
        $totalKeys = count($keys);

        // First key
        $firstKey = $keys[0];

        // Check first key
        if (mb_strlen($firstKey) > 0 && isset($array[$firstKey])) {
            if ($totalKeys === 1) {
                return $array[$firstKey];
            } else {
                // Remove the first key
                array_shift($keys);

                return get_array_dot($array[$firstKey], implode('.', $keys), $originalKey);
            }
        } else {
            throw new \Exception('get_array_dot, invalid key "' . $originalKey . '"');
        }
    }

}


if (!function_exists('set_array_dot')) {

    /**
     * Set array with dot notation
     * @param array $array
     * @param string $key
     * @param type $value
     * @param string $originalKey
     * @throws Exception
     */
    function set_array_dot(array &$array, string $key, $value, string $originalKey = null)
    {
        // Original key
        if (is_null($originalKey)) {
            $originalKey = $key;
        }

        // Explode key
        $keys      = array_map('trim', explode('.', $key));
        $totalKeys = count($keys);

        // First key
        $firstKey = $keys[0];

        // Check first key
        if (mb_strlen($firstKey) > 0) {
            // One key
            if ($totalKeys === 1) {
                $array[$firstKey] = $value;
            }

            // Several keys
            if ($totalKeys > 1) {
                // Does first key exist ?
                if (!isset($array[$firstKey])) {
                    $array[$firstKey] = [];
                }

                // Remove the first key
                array_shift($keys);

                // Next keys
                set_array_dot($array[$firstKey], implode('.', $keys), $value, $originalKey);
            }
        } else {
            throw new \Exception('set_array_dot, invalid key "' . $originalKey . '"');
        }
    }

}
