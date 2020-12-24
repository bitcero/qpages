<{foreach item=cat from=$block.categos}>
<div class="<{cycle values="even,odd"}>" style="padding-left: <{$cat.ident}>px;">
	<a href="<{$cat.link}>"><{$cat.nombre}></a>
</div>
<{/foreach}>