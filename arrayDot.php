<?php

if (!function_exists('setArrayDot')) {

    /**
     * Set array with dot notation
     * @param array $array
     * @param string $key
     * @param type $value
     * @param string $originalKey
     * @throws Exception
     */
    function setArrayDot(array &$array, string $key, $value, string $originalKey = null)
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
        if (!empty($firstKey)) {
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
                setArrayDot($array[$firstKey], implode('.', $keys), $value, $originalKey);
            }
        } else {
            throw new Exception('setArrayDot, invalid key "' . $originalKey . '"');
        }
    }

}

if (!function_exists('getArrayDot')) {

    /**
     * Get array with dot notation
     * @param array $array
     * @param string $key
     * @param string $originalKey
     * @return mixed
     * @throws Exception
     */
    function getArrayDot(array &$array, string $key, string $originalKey = null)
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
        if (!empty($firstKey) && isset($array[$firstKey])) {
            if ($totalKeys === 1) {
                return $array[$firstKey];
            } else {
                // Remove the first key
                array_shift($keys);

                return getArrayDot($array[$firstKey], implode('.', $keys), $originalKey);
            }
        } else {
            throw new Exception('getArrayDot, invalid key "' . $originalKey . '"');
        }
    }

}
