<?php

class Progress extends Wayfinder {

    private $_stuff, $_db;

    function __construct() {
        $this->load('libraries', 'db');
        $this->_db = new Db();
    }

    public function getActivities($user, $filter = false) {
        if(!$user) {
            $user = $this->_db->escape($_SESSION['userId']);
        } else {
            $user = $this->_db->escape($user);
        }
        $sql = "SELECT * FROM progress WHERE deleted = 0 AND user_id = ".$user;

        if($filter) {
            $sql .= " AND activity = ";
            switch($filter) {
                case 'football':
                    $sql .= 1;
                    break;
                case 'hula':
                    $sql .= 3;
                    break;
                case 'walking':
                    $sql .= 2;
                    break;
                case 'cycling':
                default:
                    $sql .= 0;
                    break;
            }
        }

        $sql .= " ORDER BY activity_date DESC";

        return $this->_db->query($sql);
    }

    public function getActivity($activityId) {
        $activityId = $this->_db->escape($activityId);
        $sql = "SELECT * FROM progress WHERE id = ".$activityId." LIMIT 1";
        return $this->_db->query($sql)[0];
    }

    public function createActivitiy() {
        $sql ="INSERT INTO progress SET ";
        $cols = [];
        foreach($_POST as $key => $val) {
            if($val !== '') {
                $cols[] = $this->_db->escape($key)." = '".$this->_db->escape($val)."'";
            }
        }
        $sql .= join(', ', $cols);

        if(!$this->_db->query($sql)) {
            echo $this->_db->error();
            return false;
        }
        $id = $this->_db->lastInsertId();
        return $id;
    }

    public function updateActivity() {

    }

    public function deleteActivity($activityId) {
        $activityId = $this->_db->escape($activityId);
        $user = $this->_db->escape($_SESSION['userId']);
        //$sql = "DELETE FROM progress WHERE user_id = ".$user." AND id = ".$activityId." LIMIT 1";
        $sql = "UPDATE progress SET deleted = 1 WHERE user_id = ".$user." AND id = ".$activityId." LIMIT 1";
        return $this->_db->query($sql);
    }

    /**
    * $timePeriod can be week, month, year or alltime
    * $compareWithPreviousPeriod does not apply when $time is set to 'alltime'
    **/
    public function getUsersAverageSpeed($userId, $timePeriod = 'alltime', $compareWithPreviousPeriod = false) {
        $sql = "SELECT AVG(time) as time, AVG(distance) as distance
                FROM progress
                WHERE
                user_id = ".$this->_db->escape($_SESSION['userId'])."
                AND activity = 0
                ORDER BY activity_date DESC";
        $result = $this->_db->query($sql);

        if(isset($result[0]['time']) && !is_null($result[0]['time'])) {
            return $result[0];
        }
        return false;
    }

    /**
    * $timePeriod can be week, month, year or alltime
    * $compareWithPreviousPeriod does not apply when $time is set to 'alltime'
    **/
    public function getUsersAverageDistanceCovered($userId, $timePeriod) {
    }

    /**
    * $timePeriod can be week, month, year or alltime
    * $compareWithPreviousPeriod does not apply when $time is set to 'alltime'
    **/
    public function getUsersAverageTimeSpent($userId, $timePeriod) {
    }

    /**
    * $timePeriod can be week, month, year or alltime
    **/
    public function getLeaderboard($timePeriod) {
    }

    public function getDistanceCycled($weeks = 4) {
        $sql = "SELECT SUM(distance) as total_distance, CONCAT(YEAR(activity_date), '/', WEEK(activity_date)) as week
                FROM progress
                WHERE deleted = 0
                AND activity = 0
                AND activity_date >= (NOW() - INTERVAL 4 WEEK)
                GROUP BY week
                ORDER BY week DESC";

        return $this->_db->query($sql);
    }

}
