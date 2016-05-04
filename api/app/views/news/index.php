<?php
use yii\helpers\Html;
?>
<?php if (isset($dataProvider)) : ?>
    <?php foreach ($dataProvider->getModels() as $model) : ?>
<div class="row">
    <div class="news bg-white">
        <?php if (!empty($model->image)) : ?>
        <img class="pull-left hidden-xs" src="<?= $model->image ?>">
        <?php endif ?>
        <h3><a class="color-red" href="/tin-tuc/<?= $model->alias ?>.html"><?= Html::encode($model->title) ?></a></h3>
        <p class="text-muted"><span class="fa fa-calendar"></span> <?= Html::encode($model->createdAt) ?></p>
        <p><?= Html::encode($model->description) ?></p>
        <a class="btn btn-primary pull-right" href="/tin-tuc/<?= $model->alias ?>.html" role="button">Đọc tiếp</a>
    </div>
</div>
    <?php endforeach ?>
<?php
    $pagination = $dataProvider->getPagination();
    $currentPage = $pagination->getPage();
?>
    <?php if ($currentPage < $pagination->getPageCount() - 1) : ?>
<div class="row"><a class="btn btn-primary btn-raised jscroll-next" href="<?= $pagination->createUrl($currentPage + 1, null, true) ?>" style="width: 100%" role="button">Xem thêm</a></div>
    <?php endif ?>
<?php endif ?>
