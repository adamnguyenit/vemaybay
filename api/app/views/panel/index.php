<?php if (isset($dataProvider)) : ?>
    <?php foreach ($dataProvider->getModels() as $model) : ?>
<div class="panel"><a href="<?= $model->link ?>"><img src="<?= $model->imageUrl ?>"></a></div>
    <?php endforeach ?>
<?php endif ?>
