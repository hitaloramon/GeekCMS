<div class="container">
    <div class="links ml-auto mt-2 mb-2">
        <?php $social = new Social(); $social = $social->getSocial(); foreach ($social as $s): ?>
            <a href="<?php echo $s['url']; ?>" title="<?php echo $s['name']; ?>" target="_blank" rel="noopener noreferrer" class="link p-10"><i class="<?php echo $s['icon'];?>"></i></a>
        <?php endforeach; ?>
    </div>
</div>