<?php if (isset($dataProvider)) : ?>
<div class="carousel-inner" role="listbox">
    <?php foreach ($dataProvider->getModels() as $index => $model) : ?>
    <div class="item<?= $index == 0 ? ' active' : null ?>"><a href="<?= $model->link ?>"><img src="<?= $model->imageUrl ?>"></a></div>
    <?php endforeach ?>
</div>
<?php endif ?>
