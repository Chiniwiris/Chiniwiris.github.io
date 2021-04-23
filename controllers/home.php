<?php
    require_once 'models/journeymodel.php';
    require_once 'models/joincategoriesjourneymodel.php';
    require_once 'models/categoriesmodel.php';
    require_once 'controllers/home-classes/googleCharts.php';
    require_once 'controllers/home-classes/HomeAjax.php';
    require_once 'controllers/home-classes/createHomeItem.php';
    class Home extends SessionController{
        private $user;

        function __construct(){
            parent::__construct();
            $this->user = $this->getUserSessionData();
        }

        public function render(){
            $journeyModel = new JourneyModel();
            $mostRecentTask = $journeyModel->getMostRecentTask($this->user->getId());
            $journey = new JoinCategoriesJourneyModel();
            $categories = new CategoriesModel();
            
            $this->view->render('home/index', [
                'user' => $this->user,
                'categories'=> $categories->getAll(),
                'mostRecentTask' => $mostRecentTask
            ]);
        }


        //create UI
        public function create(){
            $categories = new CategoriesModel();
            $this->view->render('home/create', [
                "categories" => $categories->getAll(),
                "user" => $this->user
            ]);
        }

        public function getLastTask(){
            $journeyModel = new JourneyModel();
            $res = $journeyModel->getMostRecentTask($this->user->getId());
            echo json_encode($res);
        }

        public function newTask(){
            $createHomeItem = new CreateHomeItem();
            $new = $createHomeItem->newTask($this->user->getId());
            echo 'hola'. $new;
        } 

        //

        public function getThisMonthJourneyJSONforGoogleChart(){
            $googleChartJSON = new GoogleCharts();
            $json = $googleChartJSON->getThisMonthJourneyJSONforGoogleChart($this->user->getId());
            echo $json;
        }

        public function getLastMonthJourneyJSONforGoogleChart(){
            $googleChartJSON = new GoogleCharts();
            $json = $googleChartJSON->getLastMonthJourneyJSONforGoogleChart($this->user->getId());
            echo $json;
        }
        

        //JSON for AJAX

        public function getThisMonthUserJourney(){
            $homeajax = new HomeAjax();
            return $homeajax->getThisMonthUserJourney($this->user->getId());
        }

        public function getLastMonthUserJourney(){
            $homeajax = new HomeAjax();
            return $homeajax->getLastMonthUserJourney($this->user->getId());
        }
    }
?>