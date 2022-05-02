//<?php
/**
 * sSetting
 *
 * Enter field names separated by commas. English only, no spaces. Tab allocation is a prefix (valid: basic_). The type of the field following the block after the prefix, (valid: _text_). For multilingual use a suffix (for example: _en). A complete example of a field name would look like basic_text_phone_en.
 *
 * @category    plugin
 * @version 1.0
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
 * @package evo
 * @internal    @events OnManagerMenuPrerender,OnManagerPageInit
 * @internal    @modx_category Manager and Admin
 * @internal    @properties &showBasicTab=Show Basic Tab;list;yes,not;yes;yes;Display tab with basic information &fields=Names of the fields;textarea;basic_text_phone,basic_text_email;basic_text_phone,basic_text_email;See information tab
 * @internal    @installset base
 * @reportissues    https://github.com/evolution-cms/evolution/issues/
 * @documentation   Official docs https://seigerit.com
 * @author  Seiger from https://seigerit.com
 * @lastupdate  02/05/2022
 */

require MODX_BASE_PATH."assets/plugins/seigersetting/plugin.seigersetting.php";