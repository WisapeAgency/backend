
<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'request-form-b',
        'enableAjaxValidation'=>true,
        //'action'=>array('site/createb')
        'htmlOptions'=>array(
            'onsubmit'=>"return false;",/* Disable normal form submit */
            'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
        ),
    )); ?>
    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php echo $form->errorSummary($request_model_b); ?>
    <div class="row">
        <?php echo $form->labelEx($request_model_b,'first_name'); ?>
        <?php echo $form->textField($request_model_b,'first_name',array('size'=>50,'maxlength'=>50,'value'=>'First Name','onclick'=>'if(this.value == \'First Name\'){ this.value=\'\';}else if(this.value==\'\'){ this.value=\'First Name\';}')); ?>
        <?php echo $form->error($request_model_b,'first_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($request_model_b,'last_name'); ?>
        <?php echo $form->textField($request_model_b,'last_name',array('size'=>50,'maxlength'=>50)); ?>
        <?php echo $form->error($request_model_b,'last_name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($request_model_b,'company_name'); ?>
        <?php echo $form->textField($request_model_b,'company_name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($request_model_b,'company_name'); ?>
    </div>
    <?php
    $this->widget('ext.countrySelectorWidget', array(
        'value' => $request_model_b->country,
        'name' => Chtml::activeName($request_model_b, 'country'),
        'id' => Chtml::activeId($request_model_b, 'country'),
        'useCountryCode' => false,
        'firstEmpty' => true,
    ));
    ?>
    <div class="row">
        <?php echo $form->labelEx($request_model_b,'user_email'); ?>
        <?php echo $form->textField($request_model_b,'user_email',array('size'=>60,'maxlength'=>100)); ?>
        <?php echo $form->error($request_model_b,'user_email'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($request_model_b,'message'); ?>
        <?php echo $form->textArea($request_model_b,'message',array('rows'=>6, 'cols'=>50)); ?>
        <?php echo $form->error($request_model_b,'message'); ?>
    </div>
    <?php echo $form->hiddenField($request_model_b,'req_type',array('value'=>1)); ?>
    <div class="row buttons">
        <?php //echo CHtml::submitButton($request_model_b->isNewRecord ? 'Create' : 'Save'); ?>
        <?php echo CHtml::ajaxSubmitButton(Yii::t('app', 'Submit')); ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
<script type="text/javascript">
    function send()
    {
        var data=$("#person-form-edit_person-form").serialize();
        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("person/ajax"); ?>',
            data:data,
            success:function(data){
                alert(data);
            },
            error: function(data) { // if error occured
                alert("Error occured.please try again");
                alert(data);
            },

            dataType:'html'
        });

    }
</script>