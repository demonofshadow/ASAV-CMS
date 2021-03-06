<?php

/**
 * This is the model class for table "children".
 *
 * The followings are the available columns in table 'children':
 * @property integer $Id
 * @property integer $Sponsor
 * @property string $Firstname
 * @property string $Lastname
 * @property string $Birthday
 * @property integer $Genre
 *
 * The followings are the available model relations:
 * @property Childmessages[] $childmessages
 * @property Genres $genre
 * @property Users $sponsor
 * @property Media[] $medias
 * @property Relationships[] $relationships
 * @property Reports[] $reports
 */
class Child extends CActiveRecord
{
	public function getFullname(){
		return $this->Firstname . " " . $this->Lastname;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Child the static model class
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
		return 'children';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Firstname, Lastname, Birthday, Genre', 'required'),
			array('Sponsor, Genre, host, tutor', 'numerical', 'integerOnly'=>true),
			array('Firstname, Lastname', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, Sponsor, Firstname, Lastname, Birthday, Genre', 'safe', 'on'=>'search'),
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
			'childmessages' => array(self::HAS_MANY, 'Childmessages', 'Child'),
			'genre' => array(self::BELONGS_TO, 'Genre', 'Genre'),
			'sponsor' => array(self::BELONGS_TO, 'User', 'Sponsor'),
			'picture' => array(self::BELONGS_TO, 'Media', 'Picture'),
			'medias' => array(self::HAS_MANY, 'Media', 'Child'),
			'relationships' => array(self::HAS_MANY, 'Relationship', 'Child'),
			'tutor' => array(self::HAS_ONE, 'Person', array('Person'=>'Id'), 'through'=>'relationships', 'condition'=>'IsTutor = 1'),
			'tutorRelation' => array(self::HAS_ONE, 'Relationship', 'Child', 'condition'=>'IsTutor = 1'),
			'host' => array(self::HAS_ONE, 'Person', array('Person'=>'Id'), 'through'=>'relationships', 'condition'=>'IsHosted = 1'),
			'reports' => array(self::HAS_MANY, 'Reports', 'Child'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'Sponsor' => 'Parrain',
			'Firstname' => 'Prénom',
			'Lastname' => 'Nom',
			'Birthday' => 'Date de naissance',
			'Genre' => 'Genre',
			'Address' => 'Adresse',
			'tutor' => 'Tuteur légal',
			'host' => 'Hôte',
			'Picture' => 'Image de profil'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$sort = new CSort();
		$sort->attributes = array(
			'Genre'=>array(
				'asc'=>'genre.Name ASC',
				'desc'=>'genre.Name DESC',
			),
			'Sponsor'=>array(
				'asc'=>'sponsor.Firstname, sponsor.Lastname ASC',
				'desc'=>'sponsor.Firstname, sponsor.Lastname DESC',
			),
			'*',
		);
		
		$criteria=new CDbCriteria;		
		
		$criteria->compare('t.Id',$this->Id);
		$criteria->compare('sponsor.Fullname',$this->sponsor);
		$criteria->compare('t.Firstname',$this->Firstname,true);
		$criteria->compare('t.Lastname',$this->Lastname,true);
		$criteria->compare('t.Birthday',$this->Birthday,true);
		$criteria->compare('genre.Name',$this->genre);
		
		$criteria->with = array('genre','sponsor');
		
		
		return new CActiveDataProvider($this, array(
	        'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 25,
			),
			'sort'=>$sort,
		));
	}
}