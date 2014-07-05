<h1 class="cu-section-title"><i class="icon-dashboard"></i> <?php _e('Dashboard','qpages'); ?></h1>
<div id="qp-dashboard-container" class="row" data-boxes="load" data-news="load" data-module="qpages" data-target="#qp-news-content">

	<div id="qp-dash-left" class="col-md-5" data-box="qpages-box-left">

		<div class="cu-box box-collapse">
            <div class="box-header">
                <span class="fa fa-caret-up box-handler"></span>
                <h3><?php _e('Recent Pages','qpages'); ?></h3>
            </div>
			<div class="box-content collapsable" id="qp-recent-pages">
                <ul class="list-unstyled">
				<?php if(empty($pages)): ?>
				<li class="text-center">
					<span class="label label-info"><?php _e('There are not pages created yet!','qpages'); ?></span>
				</li>
				<?php endif; ?>
				<?php foreach($pages as $page): ?>
				<li>
                    <span class="badge"><span class="fa <?php echo $page['type'] == 'redir' ? 'fa-link' : 'fa-file-text'; ?>"></span></span>
					<a href="<?php echo $page['link']; ?>"><strong><?php echo $page['title']; ?></strong></a>
					<?php if(!$page['public']): _e('[Draft]','qpages'); endif;?>
					&nbsp;
					(<a href="pages.php?op=edit&amp;id=<?php echo $page['id']; ?>"><?php _e('Edit','qpages'); ?></a>)
					<span class="help-block"><small><?php echo $page['desc']; ?></small></span>
				</li>
				<?php endforeach; ?>
                </ul>
			</div>
		</div>
	
		<div class="cu-box">
			<div class="box-header">
                <span class="fa fa-caret-up box-handler"></span>
                <h3><?php _e('Quick Pages News','qpages'); ?></h3>
            </div>
		    <div class="box-content collapsable" id="qp-news-content">

			</div>
		</div>
		
		<?php foreach($left_widgets as $w): ?>
		<div class="cu-box">
            <div class="box-header">
                <span class="fa fa-caret-up box-handler"></span>
                <h3><?php echo $w['title']; ?></h3>
            </div>
			<div class="box-content collapsable">
				<?php echo $w['content']; ?>
			</div>
		</div>
		<?php endforeach; ?>
		
	</div>

	<div id="qp-dash-right" class="col-md-7" data-box="qpages-box-right">
		
		<div class="cu-box">
            <div class="box-header">
                <span class="fa fa-caret-up box-handler"></span>
                <h3><?php _e('Pages Statistics','qpages'); ?></h3>
            </div>
            <div class="box-content collapsable">
                <img src="<?php echo $chart; ?>" title="<?php _e('Most viewed pages'); ?>" />
            </div>
		</div>
		
		<?php foreach($left_widgets as $w): ?>
		<div class="qp_widget_container">
			<div class="outer">
				<div class="th"><?php echo $w['title']; ?></div>
				<div class="even"><?php echo $w['content']; ?></div>
			</div>
		</div>
		<?php endforeach; ?>

        <div data-box="module-box-right"></div>

        <div class="row">
            <div class="col-sm-6" data-box="module-box-right-left"></div>
            <div class="col-sm-6" data-box="module-box-right-right"></div>
        </div>
		
	</div>
	
</div>