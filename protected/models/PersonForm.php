<?php
class PersonForm extends CFormModel
{

    public $name;
    public $age;

    /**
     * Declares the validation rules.
     * title is required
     */
    public function rules()
    {
        return array(
            array('name, age', 'required'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'name'=>'Name',
            'age'=>'Age',
        );
    }

}