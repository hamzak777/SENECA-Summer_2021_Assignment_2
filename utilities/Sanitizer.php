<?php
/**
 * Utility classes, or helper classes, are classes which are used as librariess for grouping related methods and properties toegether to be used by other classes, or sometimes, outside of classes, and dare not used to model data independently. They are normally classes which contain only static methods and properties.
 * 
 * Static classes would be used when you have a class which is used fairly commonly accross your program by other classes or even outside of classes but is not reliant on an instance of a class. In general, you would want to use static classes relatively sparingly with the exception of utility classes.
 * 
 * Our user data must be sanitized and validated but we should not define all of these methods in our Model class like we did when we used them with our Car class. According to the Single Responsibility Principle of object-oriented programming, a class should only have a single reason to change.
 * 
 * Therefore, to keep things more organized and to keep our responsibilities separated, we are using a dedicated utility class for defining sanitization and validation methods.
 */
class Sanitizer {
  private static $name_chars = '/([^a-zA-Z\-. ]+)/';
  private static $file_chars = '/([^a-zA-Z0-9\-_.]+)/';

  public static function filter_input($string, $special_chars = '//') {
    $trim_space = trim($string);
    $strip_tags = strip_tags($trim_space);
    $remove_chars = preg_replace($special_chars, '', $strip_tags);
    return $remove_chars;
  }

  public static function format_name($name) {
    $filtered = self::filter_input($name, self::$name_chars);
    $lowercase = strtolower($filtered);
    $capitalized = ucwords($lowercase);
    return $capitalized;
  }

  public static function filter_file($input_file, $files_array) {
    $filtered = self::filter_input($input_file, self::$file_chars);
    $file_name = strtolower($filtered);

    foreach ($files_array as $item_name) {
      if ($item_name == $file_name) {
        return $file_name;
      }
    }
  }

  public static function filter_number($number) {
    $filter_int = filter_var($number, FILTER_SANITIZE_NUMBER_INT);
    return (int) $filter_int;
  }

  public static function escape_html($string) {
    $convert_charset = mb_convert_encoding($string, 'UTF-8', 'UTF-8');
    $encode_html = htmlspecialchars($convert_charset, ENT_QUOTES, 'UTF-8');
    return $encode_html;
  }

  public static function sanatize_string($string, $special_chars = null) {
    // Remove white space from the beginning and end of the string
    $string_trim = trim($string);
    // TRY to strip HTML tags from user input to avoid hacking
    // This function tries its best but might miss some stuff
    $string_strip_tags = strip_tags($string_trim);
    // Remove these special characters and replace them with an empty string
    $string_remove_chars = preg_replace($special_chars, '', $string_strip_tags);
    // Convert any remaining HTML or special characters into plain text
    $string_sanatized = htmlspecialchars($string_remove_chars, ENT_QUOTES, 'UTF-8');
    // Export sanitized string
    return $string_sanatized;
  }
}