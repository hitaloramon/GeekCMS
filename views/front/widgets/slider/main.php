<?php 
    if(isset($info[2])){
        $ModSlider = new ModSlider();
        $slider = $ModSlider->getSlider($info[2]);
    
        $config = json_decode($slider['config'], true);
    }
?>

<script>
    var msc_slider_data = <?php echo $slider['config']; ?>;
    var my_slider = new MySlider();
</script>