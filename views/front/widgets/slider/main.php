<?php 
    if(isset($widget[1])){
        $ModSlider = new ModSlider();
        $slider = $ModSlider->getSlider($widget[1]);
    
        $config = json_decode($slider['config'], true);
    }
?>

<script>
    var msc_slider_data = <?php echo $slider['config']; ?>;
    var my_slider = new MySlider();
</script>