<?php

namespace backend\controllers;

use Yii;
use backend\models\branches;
use backend\models\branchesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * BranchesController implements the CRUD actions for branches model.
 */
class BranchesController extends Controller {

  /**
   * @inheritdoc
   */
  public function behaviors() {
    return [
        'access' => [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => ['login', 'error'],
                    'allow' => true,
                ],
                [
                    'actions' => ['logout', 'index','create','update','view','delete','branch'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ],
        'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['POST'],
            ],
        ],
    ];
  }

  /**
   * Lists all branches models.
   * @return mixed
   */
  public function actionIndex() {
    $searchModel = new branchesSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

    return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
    ]);
  }

  /**
   * Displays a single branches model.
   * @param integer $id
   * @return mixed
   */
  public function actionView($id) {
    return $this->render('view', [
                'model' => $this->findModel($id),
    ]);
  }

  /**
   * Creates a new branches model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate() {
   
    $model = new branches();

    if ($model->load(Yii::$app->request->post())){ 
      
        if($model->save()){
          echo 1;
        }
        else{
          echo 0;
        }
      //return $this->redirect(['view', 'id' => $model->branch_id]);
    } else {
      return $this->renderAjax('create', [
                  'model' => $model,
      ]);
    }
  }

  /**
   * Updates an existing branches model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   */
  public function actionUpdate($id) {
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->branch_id]);
    } else {
      return $this->render('update', [
                  'model' => $model,
      ]);
    }
  }

  /**
   * Deletes an existing branches model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   */
  public function actionDelete($id) {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  
  public function actionBranch($id)
    {
   
        $countBranches = branches::find()
                ->where(['branch_company_id' => $id])
                ->count();
        
        $branches = branches::find()
                ->where(['branch_company_id' => $id])
                ->orderBy('branch_name DESC')
                ->all();
       
           if($countBranches>0){
            foreach($branches as $branch){
                echo "<option value='".$branch->branch_id."'>".$branch->branch_name."</option>";
            }
        }
        else{
            //echo "<option>-</option>";
        }
        
        //echo "<option>-</option>";

    }
  /**
   * Finds the branches model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return branches the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id) {
    if (($model = branches::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('The requested page does not exist.');
    }
  }

}
