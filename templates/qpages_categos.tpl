<!-- Página en esta Categoría -->
<{if $page_count>0}>
<div class="qpPagesPages"><h2><{$lang_pages}></h2></div>
<table class="table" cellspacing="0">
	<tr class="head" align="center">
		<td align="left"><{$lang_page}></td>
		<td><{$lang_modified}></td>
		<td><{$lang_hits}></td>
	</tr>
	<{foreach item=page from=$pages}>
		<tr align="center" class="<{cycle values="even,odd}>">
			<td align="left"><a href="<{$page.link}>"><{$page.title}></a><br /><{$page.desc}></td>
			<td align="center" nowrap="nowrap"><{$page.modified}></td>
			<td align="center"><strong><{$page.hits}></strong></td>
		</tr>
	<{/foreach}>
</table>
<{/if}>

<!-- Subcategorías -->
<{if $subcats_count>0}>
	<table class="table">
		<tr><th colspan="3"><{$lang_subcats}></th></tr>
		<tr class="even" valign="top">
			<{assign var="i" value=1}>
			<{foreach item=sub from=$categos}>
				<{if $i>3}>
					</tr><tr class="<{cycle values="odd,even"}>" valign="top">
					<{assign var="i" value=1}>
				<{/if}>
				<td width="33%"><a href="<{$sub.link}>"><{$sub.nombre}></a><span class="subdesc"><{$sub.desc}></span>
				<{$sub.pages_count}></td>
				<{assign var="i" value=$i+1}>
			<{/foreach}>
		</tr>
	</table>
<{/if}>