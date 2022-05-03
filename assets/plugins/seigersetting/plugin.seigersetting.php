<?php $e = evo()->event;

/**
 * Add Menu item
 */
if ($e->name == 'OnManagerMenuPrerender') {
    global $_lang;

    if (is_file(__DIR__ . '/lang/' . evo()->getConfig('manager_language', 'uk') . '.php')) {
        require_once __DIR__ . '/lang/' . evo()->getConfig('manager_language', 'uk') . '.php';
    }

    $menu['ssettings'] = [
        "ssettings",
        "tools",
        "<i class=\"fas fa-cog\"></i> <span class=\"menu-item-text\">".$_lang['ssettings_title']."</span>",
        "index.php?a=150",
        $_lang['ssettings_title'],
        "",
        "",
        "main",
        0,
        6,
        "",
    ];
    $e->addOutput(serialize(array_merge($e->params['menu'], $menu)));
}

/**
 * Add the route to finder
 */
if ($e->name == 'OnManagerPageInit') {
    View::getFinder()->prependNamespace('manager', __DIR__ . '/views/');
    View::getFinder()->setPaths([__DIR__ . '/views', MODX_MANAGER_PATH . 'views']);
}