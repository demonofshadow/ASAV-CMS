<?php

class DashboardController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}
	
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('index'),
						'roles'=>array(
									'staff',
									'admin'
								),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		// Get the reports to validate
		$criteria=new CDbCriteria;
		$criteria->addCondition('Status=4');
		$reportProvider=new CActiveDataProvider('Report', array('criteria'=>$criteria));
		$this->render('index',array(
			'reportProvider'=>$reportProvider,
		));
	}
}