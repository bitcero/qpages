<{foreach item=page from=$block.pages}>
	<div class="<{cycle values="even,odd"}>">
		<a href="<{$page.link}>"><{$page.titulo}></a>
	</div>
<{/foreach}>