<?php
/* @var $this SubscribeController */
/* @var $model Subscribe */
/* @var $form CActiveForm */
?>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'subscribe-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'user_email'); ?>
        <?php echo $form->textField($model,'user_email',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'user_email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'createtime'); ?>
        <?php echo $form->textField($model,'createtime'); ?>
        <?php echo $form->error($model,'createtime'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->