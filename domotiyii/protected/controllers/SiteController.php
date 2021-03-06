<?php

class SiteController extends Controller
{
	// overwrite default rules
	public function accessRules()
	{
		return array(
			array('allow',  // allow everybody
				'users'=>array('*'),
			),
		);
	}    

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {
				Yii::app()->user->setFlash('success', Yii::t('app','Successfully logged in.'));
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		// display the login form
		$this->render('login', array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
                Yii::app()->user->setFlash('success', Yii::t('app','Logged out.'));
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionAbout()
	{
		// renders the view file 'protected/views/site/about.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('about');
	}

	public function actionHelp()
	{
		// renders the view file 'protected/views/site/help.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('help');
	}
}
