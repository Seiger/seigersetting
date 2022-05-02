<div class="container container-body">
    <div class="row form-row form-element-input">
        <label for="site_name" class="control-label col-5 col-md-3 col-lg-2">
            {{$_lang["ssettings_".$tab['name']] ?? $tab['name']}}
            <small class="form-text text-muted">[(sit_{{$tab['name']}})]</small>
        </label>
        <div class="col-7 col-md-9 col-lg-10">
            <input class="form-control" type="text" id="{{$tab['name']}}" name="sit_{{$tab['name']}}" value="{{evo()->getConfig('sit_'.$tab['name'], '')}}" onchange="documentDirty=true;" maxlength="255">
            <small class="form-text text-muted">{{$_lang["ssettings_".$tab['name'].'_description'] ?? ''}}</small>
        </div>
    </div>
    <div class="split my-1"></div>
</div>