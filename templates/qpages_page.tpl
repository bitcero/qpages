<article>
    <header>
        <h2><{$page.title}></h2>
    </header>
    <section class="qpages-text">
        <{$page.text}>
    </section>
    <footer class="help-block text-right">
        <small><{$page.mod_date}> | <{$page.reads}></small>
    </footer>
</article>

<{if $show_related && $related_num>0}>
	<table class="table">
		<tr><th colspan="3"><{$lang_related}></th></tr>
		<tr class="head" align="center">
			<td align="left"><{$lang_page}></td>
			<td class="text-center"><{$lang_modified}></td>
			<td class="text-center"><{$lang_hits}></td>
		</tr>
		<{foreach item=page from=$related}>
			<tr>
				<td><a href="<{$page.link}>"><{$page.title}></a><br><{$page.desc}></td>
				<td class="text-center" nowrap="nowrap"><{$page.modified}></td>
				<td class="text-center"><strong><{$page.hits}></strong></td>
			</tr>
		<{/foreach}>
	</table>
<{/if}>