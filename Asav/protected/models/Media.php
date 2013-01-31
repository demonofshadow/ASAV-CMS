<?php

/**
 * This is the model class for table "media".
 *
 * The followings are the available columns in table 'media':
 * @property integer $Id
 * @property integer $Author
 * @property integer $Child
 * @property string $Path
 * @property string $Title
 * @property string $Description
 * @property string $Created
 * @property string $Modified
 *
 * The followings are the available model relations:
 * @property Children $child
 * @property Users $author
 */
class Media extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Media the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'media';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Child, Path, Title, Created', 'required'),
			array('Author, Child', 'numerical', 'integerOnly'=>true),
			array('Path, Title', 'length', 'max'=>100),
			array('Description, Modified', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Author, Child, Path, Title, Description, Created, Modified', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'child' => array(self::BELONGS_TO, 'Children', 'Child'),
			'author' => array(self::BELONGS_TO, 'Users', 'Author'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Author' => 'Author',
			'Child' => 'Child',
			'Path' => 'Path',
			'Title' => 'Title',
			'Description' => 'Description',
			'Created' => 'Created',
			'Modified' => 'Modified',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id);
		$criteria->compare('Author',$this->Author);
		$criteria->compare('Child',$this->Child);
		$criteria->compare('Path',$this->Path,true);
		$criteria->compare('Title',$this->Title,true);
		$criteria->compare('Description',$this->Description,true);
		$criteria->compare('Created',$this->Created,true);
		$criteria->compare('Modified',$this->Modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}