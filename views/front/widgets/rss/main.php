<?php if(isset($info[2])): ?>
<div id="rss<?php echo $info[2]; ?>"></div>

<?php 
    $rss = new ModRss(); 
    $rss = $rss->getRss($info[2]);
?>

<script>
$('#rss<?php echo $info[2]; ?>').FeedEk({
    FeedUrl: '<?php echo $rss['url']; ?>', 
    MaxCount: <?php echo $rss['limit_rss']; ?>, 
    ShowDesc: <?php echo $rss['show_desc']; ?>, 
    ShowPubDate: <?php echo $rss['show_date']; ?>, 
    DescCharacterLimit: <?php echo $rss['limit_desc']; ?>
});
</script>
<?php endif; ?>