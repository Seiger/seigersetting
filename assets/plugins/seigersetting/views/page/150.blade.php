<?php

use EvolutionCMS\Models\SystemSetting;

if (isset($_POST) && count($_POST)) {
    foreach ($_POST as $key => $value) {
        if (str_starts_with($key, 'sit_') && is_scalar($value)) {
            $setting = SystemSetting::whereSettingName($key)->firstOrCreate();
            $setting->setting_name = $key;
            $setting->setting_value = $value;
            $setting->save();
            evo()->setConfig($key, $value);
        }
    }

    evo()->clearCache('full');
}

global $_lang;
if (is_file(MODX_BASE_PATH . 'assets/plugins/seigersetting/lang/' . evo()->getConfig('manager_language', 'uk') . '.php')) {
    require_once MODX_BASE_PATH . 'assets/plugins/seigersetting/lang/' . evo()->getConfig('manager_language', 'uk') . '.php';
}

$configPlugin = json_decode(evo()->getPluginCode('sSettingProps')['code'], true);

$tabs = [];
if (isset($configPlugin['fields']) && trim($configPlugin['fields'])) {
    foreach (explode(',', $configPlugin['fields']) as $field) {
        $arr = explode('_', $field);
        $tab = array_shift($arr);
        $type = array_shift($arr);
        $name = implode('_', $arr);
        $tabs[$tab][] = [
            'type' => $type,
            'name' => $name,
        ];
    }
} ?>
@extends('manager::template.page')
@section('content')
    <h1><i class="fas fa-cog" data-tooltip="{{$_lang["ssettings_description"]}}"></i> {{$_lang['ssettings_title']}}</h1>
    <form name="ssettings" id="ssettings" class="content" method="post" action="index.php?a=150" onsubmit="documentDirty=false;">
        <div class="sectionBody">
            <div class="tab-pane" id="resourcesPane">
                <script>tpResources = new WebFXTabPane(document.getElementById('resourcesPane'), false);</script>
                @if($configPlugin['showBasicTab'] == 'yes')
                    <div class="tab-page basicTab" id="basicTab">
                        <h2 class="tab">
                            <span>{{$_lang['ssettings_basic_information']}}</span>
                        </h2>
                        <script>tpResources.addTabPage(document.getElementById('basicTab'));</script>
                        <div class="container container-body">
                            @if(isset($tabs['basic']))
                                @foreach($tabs['basic'] as $tab)
                                    @include('partials.'.$tab['type'].'Type')
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </form>
    <div id="copyright">
        {!!$_lang['ssettings_copyright']!!} <strong><a href="https://seigerit.com/" target="_blank">Seiger IT</a></strong>
    </div>
@endsection
@push('scripts.bot')
    <div id="actions">
        <div class="btn-group">
            <a id="Button1" class="btn btn-success" href="javascript:void(0);" onclick="saveForm('#ssettings');">
                <i class="fa fa-floppy-o"></i>
                <span>{{$_lang['save']}}</span>
            </a>
        </div>
    </div>
    <script>
        function saveForm(selector) {
            $(selector).submit();
        }
    </script>
    <style>
        #copyright{position:fixed;bottom:0;right:0;background-color:#0057b8;color:#ffd700;padding:5px;}
        #copyright a{color:#ffd700;}
    </style>
@endpush