<?php
/* @var $this TriggersController */
/* @var $model Triggers */

$this->widget('bootstrap.widgets.TbBreadcrumb', array(
    'links' => array(
        Yii::t('translate','Triggers') => 'index',
        Yii::t('translate','Create'),
    ),
)); ?>

<legend>
Create Trigger
</legend>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>