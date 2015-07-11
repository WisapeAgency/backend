<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'request-form-c',
        'enableAjaxValidation'=>true,
    )); ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary($request_model_c); ?>
    <div class="row">
        <?php echo $form->labelEx($request_model_c,'first_name'); ?>
        <?php echo $form->textField($request_model_c,'first_name',array('size'=>50,'maxlength'=>50,'value'=>'First Name','onclick'=>'if(this.value == \'First Name\'){ this.value=\'\';}else if(this.value==\'\'){ this.value=\'First Name\';}')); ?>
        <?php echo $form->error($request_model_c,'first_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($request_model_c,'last_name'); ?>
        <?php echo $form->textField($request_model_c,'last_name',array('size'=>50,'maxlength'=>50,'id'=>'haha')); ?>
        <?php echo $form->error($request_model_c,'last_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($request_model_c,'company_name'); ?>
        <?php echo $form->textField($request_model_c,'company_name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($request_model_c,'company_name'); ?>
    </div>
    <?php
    $this->widget('ext.countrySelectorWidget', array(
        'value' => $request_model_c->country,
        'name' => Chtml::activeName($request_model_c, 'country'),
        'id' => Chtml::activeId($request_model_c, 'country'),
        'useCountryCode' => false,
        'firstEmpty' => true,
    ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($request_model_c,'user_email'); ?>
        <?php echo $form->textField($request_model_c,'user_email',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($request_model_c,'user_email'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($request_model_c,'message'); ?>
        <?php echo $form->textArea($request_model_c,'message',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($request_model_c,'message'); ?>
    </div>
    <?php echo $form->hiddenField($request_model_c,'req_type',array('value'=>1)); ?>
    <div class="row buttons">
        <?php echo CHtml::submitButton($request_model_c->isNewRecord ? 'Create' : 'Save'); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
<!-- form -->