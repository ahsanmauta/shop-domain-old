@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
$configData = Helper::appClasses();
@endphp

@if(isset($pageConfigs["myLayout"]))
@include((($pageConfigs["myLayout"] === 'horizontal') ? 'layouts.horizontalLayout' :
(($pageConfigs["myLayout"] === 'blank') ? 'layouts.blankLayout' :
(($pageConfigs["myLayout"] === 'front') ? 'layouts.layoutFront' : 
(($pageConfigs["myLayout"] === 'user') ? 'layouts.layoutUser' : 'layouts.contentNavbarLayout')) )))
@else
@include('layouts.contentNavbarLayout')
@endif
