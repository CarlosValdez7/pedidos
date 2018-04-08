<?php

namespace app\controllers;

use Yii;
use app\models\Cliente;
use app\models\ClienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\Usuarios;

/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class ClienteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {return ['access' => [
        'class' => AccessControl::className(),
        'only' => [ 'index','view','create','update','delete'],
        'rules' => [
            [
                //El administrador tiene permisos sobre las siguientes acciones
                'actions' => ['index','view','create','update','delete'
                ],
                //Esta propiedad establece que tiene permisos
                'allow' => false,
                //Usuarios autenticados, el signo ? es para invitados
                'roles' => ['@'],
                //Este método nos permite crear un filtro sobre la identidad del usuario
                //y así establecer si tiene permisos o no
                'matchCallback' => function ($rule, $action) {
                    //Llamada al método que comprueba si es un administrador
                    return Usuarios::isUserAdmin(Yii::$app->user->identity->username);
                },
            ],
            [
                'actions' => ['index','view','create','update','delete'
                ],
                //Esta propiedad establece que tiene permisos
                'allow' => true,
                //Usuarios autenticados, el signo ? es para invitados
                'roles' => ['@'],
                //Este método nos permite crear un filtro sobre la identidad del usuario
                //y así establecer si tiene permisos o no
                'matchCallback' => function ($rule, $action) {
                    //Llamada al método que comprueba si es un administrador
                    return Usuarios::isUserSimple(Yii::$app->user->identity->username);
                },
            ],
            [
                'actions' => ['index','view','create','update','delete'
                ],
                //Esta propiedad establece que tiene permisos
                'allow' => false,
                //Usuarios autenticados, el signo ? es para invitados
                'roles' => ['?'],
                //Este método nos permite crear un filtro sobre la identidad del usuario
                //y así establecer si tiene permisos o no
                'matchCallback' => function ($rule, $action) {
                    //Llamada al método que comprueba si es un administrador

                },
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
     * Lists all Cliente models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ClienteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cliente model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cliente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cliente();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cliente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cliente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cliente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cliente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cliente::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
