<?php
/**
 * Copyright (C) 2024-2024 thirty bees
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@thirtybees.com so we can send you a copy immediately.
 *
 * @author    E-Com <e-com@presta.eu.org>
 * @author    thirty bees <modules@thirtybees.com>
 * @copyright 2024-2024 thirty bees
 * @license   Academic Free License (AFL 3.0)
 */

if (!defined('_TB_VERSION_')) {
    exit;
}

class TbDetectCrawler extends Module
{
    /**
     * @throws PrestaShopException
     */
    public function __construct()
    {
        $this->name = 'tbdetectcrawler';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'thirty bees';
        $this->controllers = [];
        $this->bootstrap = true;
        parent::__construct();
        $this->displayName = $this->l('Detect crawlers');
        $this->description = $this->l('This module implements bot detection functionality.');
        $this->need_instance = 0;
        $this->tb_versions_compliancy = '>= 1.6.0';
        $this->tb_min_version = '1.6.0';
    }

    /**
     * @return bool
     *
     * @throws PrestaShopException
     */
    public function install()
    {
        return (
            parent::install() &&
            $this->registerHook('actionDetectBot')
        );
    }

    /**
     * @return bool
     */
    public function hookActionDetectBot()
    {
        require_once(__DIR__ . '/vendor/autoload.php');
        $detect = new Jaybizzle\CrawlerDetect\CrawlerDetect();
        return $detect->isCrawler();
    }
}
