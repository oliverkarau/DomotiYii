<?php

class ActionsController extends Controller {

    /**
     * Lists all actions.
     */
    public function actionIndex() {
        $criteria = new CDbCriteria();

        $model = new Actions('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Actions'])) {
            $model->attributes = $_GET['Actions'];

            if (!empty($model->id))
                $criteria->addCondition('id = "' . $model->id . '"');
            if (!empty($model->name))
                $criteria->addCondition('name = "' . $model->name . '"');
            if (!empty($model->description))
                $criteria->addCondition('description = "' . $model->description . '"');
            if (!empty($model->type))
                $criteria->addCondition('type = "' . $model->type . '"');
        }
        $this->render('index', array('model' => $model));
    }

    public function actionView($id) {
        $model = Actions::model()->findByPk($id);
        $this->render('view', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = Actions::model()->findByPk($id);
        if (isset($_POST['Actions'])) {
            $model->attributes = $_POST['Actions'];
            if ($model->validate()) {
                // form inputs are valid, do something here
                $this->do_save($model);
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionRun($id) {
        // run the action
        $model = Actions::model()->findByPk($id);
        $this->do_run($model);
        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        // delete the entry from the "actions" table
        $model = Actions::model()->findByPk($id);
        $this->do_delete($model);
    }

    public function actionCreate() {
        $model = new Actions;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Actions'])) {
            $model->attributes = $_POST['Actions'];
            if ($model->validate()) {
                $this->do_save($model);
            }
        }
        $this->render('create', array(
            'model' => $model,
        ));
    }

    protected function do_run($model) {
        $res = doJsonRpc(array('jsonrpc' => '2.0', 'method' => 'action.run', 'params' => array('action_id' => (int) $model->id), 'id' => 1));
        if ($res) {
            if (isset($res->result) && $res->result) {
                Yii::app()->user->setFlash('success', Yii::t('app', 'Action started.'));
            } else {
                Yii::app()->user->setFlash('error', Yii::t('app', 'Action run failed!'));
            }
        }
    }

    protected function do_save($model) {
        if ($model->save() === false) {
            Yii::app()->user->setFlash('error', Yii::t('app', 'Action save failed!'));
        } else {
            Yii::app()->user->setFlash('success', Yii::t('app', 'Action saved.'));
        }
    }

    protected function do_delete($model) {

        if ($model->delete() === false) {
            Yii::app()->user->setFlash('error', Yii::t('app', 'Action delete failed!'));
        } else {
            Yii::app()->user->setFlash('success', Yii::t('app', 'Action deleted.'));
            $this->redirect(array('index'));
        }
    }
}
