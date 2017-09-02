<?php
/**
 * @license MIT
 */

namespace PressKit;

/**
 * Translates requested urls into filenames
 */
class Url
{
    private $baseDir;

    /**
     * Url constructor.
     *
     * @param string $baseDir The directory where the data files live
     */
    public function __construct($baseDir)
    {
        $this->baseDir = $baseDir;
    }

    /**
     * Returns a filename associated with this url or false if non exists
     *
     * @param string $url The url for which to find a data file
     *
     * @return bool|string
     */
    public function get($url)
    {
        if (null === $url) {
            $url = 'company';
        }

        $url = $this->sanitize($url);
        $filename = $url.'.xml';

        if ($this->exists($filename)) {
            return $filename;
        }

        return false;
    }

    /**
     * Sanitizes the string so as to remove potential attacks such as directory traversal
     *
     * @param string $url The url to sanitize
     *
     * @return string
     */
    private function sanitize($url)
    {
        $url = basename($url);

        return $url;
    }

    /**
     * Checks if the requested filename exists
     *
     * @param string $filename The filename to check
     *
     * @return bool
     */
    private function exists($filename)
    {
        if (is_file($this->baseDir.'/'.$filename)) {
            return true;
        }

        return false;
    }
}
