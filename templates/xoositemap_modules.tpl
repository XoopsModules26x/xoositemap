<{if count($module.sitemap) != 0}>
    <{foreach from=$module.sitemap item=result}>
    <{include file="module:xoositemap/xoositemap_item.tpl" item=$result}>
<{/foreach}>
<{/if}>
