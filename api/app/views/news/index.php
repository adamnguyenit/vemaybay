<?php
use yii\helpers\Html;
use yii\helpers\Url;
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
    <?php if ($currentPage < $pagination->getPageCount()) : ?>
<a class="btn jscroll-next" href="<?= $pagination->createUrl($currentPage + 1, null, true) ?>" role="button">Xem thêm</a>
    <?php endif ?>
<?php endif ?>
