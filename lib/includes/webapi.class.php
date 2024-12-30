<?php
class webapi
{
    public function __construct()
    {
        global $__site_config;
        if (php_sapi_name() == "cli") {
            $__site_path = $_SERVER["PWD"] . "/../../college.conf.json";
            $__site_config = file_get_contents($__site_path);
        } elseif (php_sapi_name() == "apache2handler") {
            $__site_path = $_SERVER["DOCUMENT_ROOT"] . "/college.conf.json";
            $__site_config = file_get_contents($__site_path);
        } else {
            $__site_config = null;
        }
        database::connection();
    }

    public function init_session()
    {
        sessions::start();
    }
}
