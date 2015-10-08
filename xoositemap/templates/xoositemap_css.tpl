<style type="text/css">
    <{foreach from=$sitemap item=cssmodule name=foo}>
    .xoositemap-ico-module <{$smarty.foreach.foo.iteration}> {
        background-image: url('<{$cssmodule.image}>');
    }

    <{/foreach}>
</style>
