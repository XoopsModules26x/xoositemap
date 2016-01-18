<{include file="module:xoositemap/xoositemap_css.tpl"}>

<{if $moduletitle != ''}>
    <fieldset>
        <legend><{$moduletitle}></legend>
    </fieldset>
<{/if}>

<{if $xoositemap_config.xoositemap_welcome}>
    <div class="xoositemapMsg">
        <{$xoositemap_config.xoositemap_welcome}>
    </div>
<{/if}>

<div class="tabbable">
    <ul class="nav nav-tabs">
        <{foreach from=$sitemap item=module name=foo}>
        <li<{if $smarty.foreach.foo.first}> class="active"<{/if}>>
            <a href="#tab<{$smarty.foreach.foo.iteration}>" data-toggle="tab" title="<{$module.name}>"><i class="xoositemap-ico-module<{$smarty.foreach.foo.iteration}>"></i><{$module.name}></a></li>
        <{/foreach}>
    </ul>

    <div class="tab-content">
        <{foreach from=$sitemap item=module name=foo}>
        <div class="tab-pane<{if $smarty.foreach.foo.first}> active<{/if}>" id="tab<{$smarty.foreach.foo.iteration}>">
            <{if $module.category}>
                <{include file="module:xoositemap/xoositemap_categories.tpl" category=$module.sitemap}>
            <{else}>
                <{include file="module:xoositemap/xoositemap_item.tpl" items=$module.sitemap}>
            <{/if}>
        </div>
        <{/foreach}>
    </div>
</div>
