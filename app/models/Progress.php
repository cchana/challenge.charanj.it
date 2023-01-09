<?php

class Progress extends Wayfinder {

    private $_stuff, $_db;

    function __construct() {
        $this->load('libraries', 'db');
        $this->_db = new Db();
    }

    public function getActivities($user) {
        if(!$user) {
            $user = $this->_db->escape($_SESSION['userId']);
        } else {
            $user = $this->_db->escape($user);
        }
        $sql = "SELECT * FROM progress WHERE deleted = 0 AND user_id = ".$user." ORDER BY activity_date DESC";
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

}
