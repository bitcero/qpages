<h1 class="cu-section-title"><i class="icon-dashboard"></i> <?php _e('Dashboard', 'qpages'); ?></h1>

<div class="row" data-boxes="load" data-news="load" data-module="qpages" data-target="#qp-news-content" data-container="dashboard" data-box="qpages-dashboard">

	<div class="size-1" data-dashboard="item">
        <div class="cu-box box-green">
            <div class="box-header">
                <span class="fa fa-caret-up box-handler"></span>
                <h3 class="box-title"><?php _e('Recent Pages', 'qpages'); ?></h3>
            </div>
            <div class="box-content collapsable" id="qp-recent-pages">
                <ul class="list-unstyled">
                    <?php if (empty($pages)): ?>
                        <li class="text-center">
                            <span class="label label-info"><?php _e('There are not pages created yet!', 'qpages'); ?></span>
                        </li>
                    <?php endif; ?>
                    <?php foreach ($pages as $page): ?>
                        <li>
                            <span class="badge"><span class="fa <?php echo $page['type'] == 'redir' ? 'fa-link' : 'fa-file-text'; ?>"></span></span>
                            <a href="<?php echo $page['link']; ?>"><strong><?php echo $page['title']; ?></strong></a>
                            <?php if (!$page['public']): _e('[Draft]', 'qpages'); endif;?>
                            &nbsp;
                            (<a href="pages.php?action=edit&amp;id=<?php echo $page['id']; ?>"><?php _e('Edit', 'qpages'); ?></a>)
                            <span class="help-block"><small><?php echo $page['desc']; ?></small></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="size-1" data-dashboard="item">
        <div class="cu-box">
            <div class="box-header">
                <span class="fa fa-caret-up box-handler"></span>
                <h3 class="box-title"><?php _e('Quick Pages News', 'qpages'); ?></h3>
            </div>
            <div class="box-content collapsable" id="qp-news-content">

            </div>
        </div>
    </div>

    <div class="size-1" data-dashboard="item">
        <div class="cu-box">
            <div class="box-header">
                <span class="fa fa-caret-up box-handler"></span>
                <h3 class="box-title"><?php _e('Pages Statistics', 'qpages'); ?></h3>
            </div>
            <div class="box-content collapsable">
                <?php if (empty($stats)): ?>
                <ul class="list-unstyled">
                    <li class="text-center">
                        <span class="label label-info"><?php _e('There are not pages created yet!', 'qpages'); ?></span>
                    </li>
                    <?php else: ?>
                        <script type="text/javascript">
                            google.load("visualization", "1", {packages:["corechart"]});
                            google.setOnLoadCallback(drawChart);
                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['<?php _e('Pages', 'qpages'); ?>', '<?php _e('Hits', 'qpages'); ?>', {role: 'style'}],
                                    <?php foreach ($stats as $data): ?>
                                    ['<?php echo $data['legend']; ?>', <?php echo $data['value']; ?>, '<?php echo $data['color']; ?>'],
                                    <?php endforeach; ?>
                                ]);

                                var options = {
                                    vAxis: {title: '<?php _e('Pages', 'qpages'); ?>',  titleTextStyle: {color: 'black'}},
                                    animation: {duration: 250},
                                    legend: {position: 'none'},
                                    height: 500
                                };

                                var chart = new google.visualization.BarChart(document.getElementById('stats'));
                                chart.draw(data, options);
                            }
                        </script>
                    <?php endif; ?>
                    <div id="stats"></div>
            </div>
        </div>
    </div>

    <?php foreach ($dashboardPanels as $panel): ?>
        <?php echo $panel; ?>
    <?php endforeach; ?>

</div>
