<?php

if (!function_exists('print_pre')) {
    /**
     *
     *
     * @param array $array
     * @param bool $exit
     * @param null $__FILE__
     * @param null $__LINE__
     * @param null $__METHOD__
     * @return void
     */
    function print_pre($array, $exit = false, $__FILE__ = NULL, $__LINE__ = NULL, $__METHOD__ = NULL)
    {
        echo "<pre>";
        echo $__FILE__ . '<br>';
        if (is_array($array)) {
            echo "<hr>";
            echo "Records \t:" . (count($array, 0));
            echo "<br>";
            echo "Data \t\t:" . (count($array, 1));

            echo "<hr>";
        } else {
            strlen($array);
        }
        print_r($array);
        echo $__FILE__ . '<br>';
        echo $__LINE__ . '<br>';
        echo $__METHOD__ . '<br>';


        if ($exit) {
            exit("</pre>");
        } else {
            echo "</pre>";
        }
    }
}

if (!function_exists('format_amount')) {
    function format_amount($amount)
    {
        return number_format((float)$amount, 2, '.', '');
    }
}

if (!function_exists('get_currency')) {
    function get_currency()
    {
        return env('CURRENCY', 'KES');
    }
}


if (!function_exists('format_date')) {
    function format_date($date)
    {
        if ($date) {
            return \Carbon\Carbon::parse($date)->format('d-M-Y');
        }
        //return date("d-M-Y", strtotime($date));
    }
}


if (!function_exists('display_date_format_and_time')) {
    function display_date_format_and_time($date, $format = "d-M-Y h:i:s A")
    {

        if ($date) {
            return \Carbon\Carbon::parse($date)->format($format);
        }

    }
}


if (!function_exists('display_date_format')) {
    function display_date_format($date, $format = "d-M-Y")
    {
        //return "hello";
        if ($date) {
            return \Carbon\Carbon::parse($date)->format($format);
        }
        //return date("j-M-Y", strtotime($date));
    }
}



if (!function_exists('country_code')) {
    function country_code()
    {
        return env('COUNTRY_CODE', '254');
    }
}

if (!function_exists('is_postgres')) {
    function is_postgres()
    {
        return env('DB_CONNECTION', 'pgsql') == 'pgsql';
    }
}

if (!function_exists('coalesce')) {
    function coalesce(...$values)
    {
        foreach ($values as $value) {
            if (!is_null($value) && $value != null) {
                return $value;
            }
        }
        return null;
    }
}


if (!function_exists('print_log')) {
    /**
     *
     *
     * @param array $array
     * @param bool $exit
     * @param null $__FILE__
     * @param null $__LINE__
     * @param null $__METHOD__
     * @return void
     */
    // Function to print log in a readable format
function print_log($array)
{
        foreach($array as $value) {
            echo $value . PHP_EOL;
        }
}

}



if (!function_exists('logformatOutput')) {
    /**
     *
     *
     * @param array $array
     * @param bool $exit
     * @param null $__FILE__
     * @param null $__LINE__
     * @param null $__METHOD__
     * @return void
     */
    // Function to print log in a readable format


    function logformatOutput($output)
    {
        // if ($output === null) {
        //     return 'Output is null';
        // }
        //   else{
        //     $json = json_decode($output, true);
        //     $result = '';
        //     foreach ($json as $key => $value) {
        //         $result .= $key . ': ';
        //         if (is_array($value)) {
        //             $result .= "\n" . logformatOutput(json_encode($value, JSON_PRETTY_PRINT));
        //         } else {
        //             $result .= $value . "\n";
        //         }
        //     }
        //     return $result;
        // }
        if ($output === null) {
            return 'NULL';
          } elseif (is_object($output) || is_array($output)) {
            $json = json_decode(json_encode($output), true);
          } else {
            $json = json_decode($output, true);
          }

          $result = '';
          foreach ($json as $key => $value) {
            $result .= $key . ': ';
            if (is_array($value)) {
              $result .= "\n" . indentString(logformatOutput(json_encode($value, JSON_PRETTY_PRINT)));
            } else {
              $result .= $value . "\n";
            }
          }
          return $result;
    }
}

if (!function_exists('indentString')) {
    /**
     *
     *
     * @param array $array
     * @param bool $exit
     * @param null $__FILE__
     * @param null $__LINE__
     * @param null $__METHOD__
     * @return void
     */
    // Function to print log in a readable format

    function indentString($string)
    {
        return preg_replace('/^/m', '  ', $string);
    }
}


if (!function_exists('json_clean')) {
    /**
     *
     *
     * @param array $array
     * @param bool $exit
     * @param null $__FILE__
     * @param null $__LINE__
     * @param null $__METHOD__
     * @return void
     */
    // Function to print log in a readable format

function json_clean($json)
{
    if (is_array($json)) {
        foreach ($json as &$element) {
            $element = json_clean($element);
        }
    } else {
        if (is_string($json)) {
            $json_object = json_decode($json);
            if (is_object($json_object)) {
                if (property_exists($json_object, 'transfer_response')) {
                    $json_object->transfer_response = stripslashes($json_object->transfer_response);
                }

                // Encode the PHP object back into a JSON string with proper formatting
                $cleaned_json = json_encode($json_object, JSON_PRETTY_PRINT);

                // Output the cleaned JSON string
                return $cleaned_json;
            }
        }
    }
}

}
