<{if count($category) != 0}>
    <{foreach from=$category item=result}>
    <{if $result.item}>
        <div class="searchItem">
            <div class="bold">
                <a href="<{$result.url}>" title="<{$result.title}>">
                    <i class="xoositemap-ico-category"></i>
                    <{$result.title}></a>
            </div>
            <{include file="module:xoositemap/xoositemap_item.tpl" items=$result.item}>
        </div>
    <{/if}>
<{/foreach}>
<{/if}>
