<?php if(isset($widget[1])): ?>
<div id="rss<?php echo $widget[1]; ?>"></div>

<?php 
    $rss = new ModRss(); 
    $rss = $rss->getRss($widget[1]);
?>

<script>
$('#rss<?php echo $widget[1]; ?>').FeedEk({
    FeedUrl: '<?php echo $rss['url']; ?>', 
    MaxCount: <?php echo $rss['limit_rss']; ?>, 
    ShowDesc: <?php echo $rss['show_desc']; ?>, 
    ShowPubDate: <?php echo $rss['show_date']; ?>, 
    DescCharacterLimit: <?php echo $rss['limit_desc']; ?>
});
</script>
<?php endif; ?>