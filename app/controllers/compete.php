<?php

class Compete extends Wayfinder {

    function __construct() {
        define('SALT', 'ee01597711cc5c57a4ac9798f397dabe4e19ff32a0ece9dda7f51cf301db3f6b1e7ed78033b3084afaf98d37c549514c19ce76d7a7b9a69c7bba79216fd87fa6');

        // 60 minutes * 24 hours * 365 days
        session_cache_expire(60*24*365);
        ini_set('session.gc_maxlifetime', 60*24*365);

        session_start();
        $this->_verifySession();
        $this->load('models', 'Users');
        $this->_users = new Users();
        $this->load('models', 'Progress');
        $this->_progress = new Progress();
    }

    public function index() {
        if(!empty($_POST)) {
            if($this->_auth($_POST['username'], $_POST['password'])) {
                header('Location: /compete/dashboard');
                exit;
            }
        }
        $data['title'] = 'Login';
        $data['users'] = $this->_users->getUsers();
        $this->_loadPage('login', $data);
    }

    public function dashboard() {
        $data['title'] = 'Dasboard';
        $data['users'] = $this->_users->getUsers();
        $data['myData'] = [
            'allTime' => [
                'average' => $this->_progress->getUsersAverageSpeed($_SESSION['userId'])
            ]
        ];
        $this->_loadPage('dashboard', $data);
    }

    public function activity($action = false) {
        if(!$action) {
            header('Location: /compete/activity/list');
            exit;
        }
        switch($action) {
            case 'list':
                $this->_activityList();
                break;
            case 'add':
                $this->_addActivity();
                break;
        }
    }

    private function _addActivity() {
        if(!empty($_POST)) {
            $_POST['time'] = '00:'.$_POST['time'];
            $id = $this->_progress->createActivitiy();
            header('Location: /compete/dashboard');
            exit;
        } else {
            $data['title'] = 'Add activity';
        }
        $this->_loadPage('activity-add', $data);
    }

    private function _activityList() {
        $data = [
            'activities' => $this->_progress->getMyActivities(),
            'title' => 'My Activities'
        ];
        $this->_loadPage('activity-list', $data);
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }

    private function _validateUser($user, $password) {
        $hash = md5(md5($user.' '.$password.' '.SALT));

        // generated by doing 'username caar md5(md5(SALT))'
        $users = [
            'cchana' => [
                '7aabb61a65ff8cb0ae5c09a5f3682a22',
                1
            ],
            'rchana' => [
                '9d82166bbc1ade777906e8db8e753d29',
                2
            ],
            'akbhatti' => [
                'c049da31e0c254bec70dcf62aee3033b',
                3
            ],
            'abhatti' => [
                'c109a8d27979c89ed085f72471684d07',
                4
            ]
        ];

        if($users[$user][0] == $hash) {
            return $users[$user][1];
        }
        return false;
    }

    private function _auth($username, $password) {
        $userId = $this->_validateUser($username, $password);
        if($userId) {
            $_SESSION['user'] = $username;
            $_SESSION['userId'] = $userId;
            $_SESSION['hash'] = $this->_generateSessionHash();
            return true;
        } else {
            return false;
        }
    }

    private function _verifySession() {
        if(isset($_SESSION['hash']) && $this->_validateSessionHash()) {
            if($_SERVER['REQUEST_URI'] == '/') {
                header('Location: /compete/dashboard');
                exit;
            }
        } else {
            if($_SERVER['REQUEST_URI'] != '/') {
                header('Location: /');
                exit;
            }
        }
    }

    private function _generateSessionHash() {
        return md5(md5(md5($_SESSION['user'].' '.SALT)));
    }

    private function _validateSessionHash() {
        if(isset($_SESSION['hash']) && $_SESSION['hash'] === $this->_generateSessionHash()) {
            return true;
        } else {
            return false;
        }
    }

    private function _loadPage($page, $data = []) {
        $this->load('views', 'global/header', $data);
        $this->load('views', $page, $data);
        $this->load('views', 'global/footer', $data);
    }

}
