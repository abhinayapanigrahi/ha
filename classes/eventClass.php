<?php
include("./classes/applicationClass.php");

class eventProcessor extends applicationProcessor{

    function getAllEvent(){
        //echo "all Event List Printed";
        $mysqli_query = "select eventId, eventTitle, eventLocation, eventOrganizers, fromDate, toDate,galleryId, eventDescription, articleId from tbl_event";
        
        $result1 = $this->sqlConect()->query($mysqli_query);
            $resultsArr = array();
            if ($result1){
            while($eventObj = $result1->fetch_object()){
                array_push($resultsArr, $eventObj);
            }

            //echo $result1->num_rows;

            return $resultsArr;
            }
    }
}