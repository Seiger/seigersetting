<?php global $_lang;

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
    <div class="sectionBody">
        <div class="tab-pane" id="resourcesPane">
            <script>tpResources = new WebFXTabPane(document.getElementById('resourcesPane'), false);</script>

            @if($configPlugin['showBasicTab'] == 'yes')
                <div class="tab-page basicTab" id="basicTab">
                    <h2 class="tab">
                        <span>{{$_lang['ssettings_basic_information']}}</span>
                    </h2>
                    <script>tpResources.addTabPage(document.getElementById('basicTab'));</script>
                    @if(isset($tabs['basic']))
                        @foreach($tabs['basic'] as $tab)
                            @include('partials.'.$tab['type'].'Type')
                        @endforeach
                    @endif
                </div>
            @endif

        </div>
    </div>
@endsection