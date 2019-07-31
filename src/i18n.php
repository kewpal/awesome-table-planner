<?php

/**
 * Verifies if the given $locale is supported in the project
 * @param string $locale
 * @return bool
 */
function valid($locale) {
    return in_array($locale, ['sv_SE', 'de_DE']);
 }

$locale = 'sv_SE';
$domain = 'messages';
$locale_dir = "../locales";

//setting the source/default locale, for informational purposes
 
if (isset($_GET['lang']) && valid($_GET['lang'])) {
    // the locale can be changed through the query-string
    $locale = $_GET['lang'];    //you should sanitize this!
    setcookie('lang', $locale); //it's stored in a cookie so it can be reused
} elseif (isset($_COOKIE['lang']) && valid($_COOKIE['lang'])) {
    // if the cookie is present instead, let's just keep it
    $locale = $_COOKIE['lang']; //you should sanitize this!
} elseif (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    // default: look for the languages the browser says the user accepts
    $locales = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
    array_walk($locales, function (&$locale) { $locale = strtr(strtok($locale, ';'), ['-' => '_']); });
    foreach ($locales as $browser_lang) {
        if (valid($browser_lang)) {
            $locale = $browser_lang;
            break;
        }
    }
}
$locale .= ".UTF-8";
$results = putenv("LC_ALL=$locale");
putenv("LANGUAGE=$locale");
if (!$results) {
    exit ('putenv failed');
}

// http://msdn.microsoft.com/en-us/library/39cwe7zf%28v=vs.100%29.aspx
$results = setlocale(LC_ALL, $locale);
if (!$results) {
    exit ('setlocale failed: locale function is not available on this platform, or the given local does not exist in this environment');
}

// this will make Gettext look for ../locales/<lang>/LC_MESSAGES/messages.mo
$results= bindtextdomain($domain, $locale_dir);
echo 'new text domain is set: ' . $results. "<br>";

// indicates in what encoding the file should be read
bind_textdomain_codeset($domain, 'UTF-8');

// here we indicate the default domain the gettext() calls will respond to
$results = textdomain($domain);
echo 'current message domain is set: ' . $results. "<br>";

$results = _("Hello");
if ($results === "Hello") {
    echo "Original English was returned. Something wrong<br>";
}
