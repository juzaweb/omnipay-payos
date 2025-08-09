<?php

/**
 * JUZAWEB CMS - Laravel CMS for Your Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang
 * @link       https://cms.juzaweb.com
 * @license    GNU V2
 */

if (! class_exists(\Omnipay\Payos\Gateway::class)) {
    class_alias(\Juzaweb\PayOs\Gateway::class, \Omnipay\Payos\Gateway::class);
}
