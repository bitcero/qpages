<{foreach item=cat from=$categos}>
	<div class="qpCategosHome">
		<h2><a href="<{$cat.link}>"><{$cat.name}></a></h2>
		<span class="catdesc"><{$cat.description}></span>
		<{if $cat.pages_count > 0}>
		<table class="table" border="0" cellapcing="2">
			<tr><th colspan="3"><{$lang_pagesin}></th></tr>
			<tr class="even" valign="top">
			<{assign var="i" value=1}>
			<{foreach item=page from=$cat.pages}>
			<{if $i>3}>
				</tr><tr valign="top">
				<{assign var="i" value=1}>
			<{/if}>
			<td width="33%"><a href="<{$page.link}>"><strong><{$page.title}></strong></a><br />
			<{$page.description}></td>
			<{assign var="i" value=$i+1}>
		<{/foreach}>
		</tr>
		</table>
		<{/if}>
		<{if $cat.subcats_count>0}>
        <br />
		<table class="table">
			<tr><th colspan="3"><{$lang_subcats}></th></tr>
			<tr class="even" valign="top">
				<{assign var="i" value=1}>
				<{foreach item=sub from=$cat.subcats}>
					<{if $i>3}>
						</tr><tr valign="top">
						<{assign var="i" value=1}>
					<{/if}>
					<td width="33%"><a href="<{$sub.link}>"><{$sub.name}></a><{$sub.description}></td>
					<{assign var="i" value=$i+1}>
				<{/foreach}>
			</tr>
		</table>
		<{/if}>
	</div>
<{/foreach}>

