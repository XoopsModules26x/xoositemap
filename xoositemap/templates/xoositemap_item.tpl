<{if count($items) != 0}>
    <{foreach from=$items item=item}>
    <div class="searchSpace">
        <div class="bold"><a href="<{$item.url}>" title="<{$item.title}>"><{$item.title}></a></div>
            <span class='x-small'>
                <{if $item.uid && $item.uname}>
                    <a href="<{$xoops_url}>/userinfo.php?uid=<{$item.uid}>" title="<{$item.uname}>"><{$item.uname}></a>
                <{/if}>
                <{if $item.date}>
                    ( <{$item.date}> )
                <{/if}>
            </span>
    </div>
<{/foreach}>
<{/if}>
