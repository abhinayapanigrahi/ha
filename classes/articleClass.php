<?php
include_once("./classes/applicationClass.php");

class articleProcessor extends applicationProcessor{

    function getAllArticle(){
            //echo "all Article List Printed";
            $mysqli_query = "select articleId, articleTitle, articleType, fromDate, toDate from tbl_article";

            $result1 = $this->sqlConect()->query($mysqli_query);
            $resultsArr = array();
            if ($result1){
            while($articleObj = $result1->fetch_object()){
                array_push($resultsArr, $articleObj);
            }

            //echo $result1->num_rows;

            return $resultsArr;
            }
    }

    function getArticleDetails($articleID){

           $mysqli_query1 = "select * from tbl_article where articleId = ".$articleID;
            
            $result2 = $this->sqlConect()->query($mysqli_query1);
            $resultsArr1 = array();
            if ($result2){
            while($articleObj = $result2->fetch_object()){
                array_push($resultsArr1, $articleObj);
            }
        }
            return $resultsArr1;
    }


    public function saveArticle($articleObject){
            if(!empty($articleObject['editID'])){
                    $articleID = $this->updateArticle($articleObject);
            }else{
                    $articleID = $this->addArticle($articleObject);
            }
            $this->updateContentForArticle($articleObject, $articleID);
        }

        private function addArticle($articleObject){
            //print_r($articleObject);
            
            $articleTitle = $articleObject['articletitle'];
            $articleType = $articleObject['articletype'];
            
            $fromDate = $articleObject['fromdate'];
            $toDate = $articleObject['todate'];
            
            $stmt =  $this->sqlConect()->prepare("INSERT INTO tbl_article SET articleTitle = ?, articleType = ?, fromDate = ?, toDate = ? ");
            
            $stmt->bind_param("ssss", $articleTitle, $articleType,$fromDate,$toDate);
            
            //print_r($stmt);

            $stmt->execute();
            $insertedID = $stmt->insert_id;

            echo "New Article Added successfully";

            $stmt->close(); 
            return $insertedID;
        }


        function updateArticle($articleObject){
            // print_r($articleObject); exit;
            $articleTitle = $articleObject['articletitle'];
            $articleType = $articleObject['articletype'];
            
            $fromDate = $articleObject['fromdate'];
            $toDate = $articleObject['todate'];
            $articleID = $articleObject['editID'];

            $stmt =  $this->sqlConect()->prepare("UPDATE tbl_article SET articleTitle = ?, articleType = ?, fromDate = ? , toDate = ? WHERE articleId = ? ");
            
            $stmt->bind_param("ssssi", $articleTitle, $articleType,$fromDate,$toDate,$articleID);
            
            //print_r($stmt);

            $stmt->execute();

            echo "New Article Records Updated Successfully";

            $stmt->close();
            return $articleID;
        }
        function updateContentForArticle($articleObject,$articleID){
            $stmt =  $this->sqlConect()->prepare("DELETE from tbl_article_content_map WHERE articleId = ? ");
            
            $stmt->bind_param("i", $articleID);
            $stmt->execute();

            foreach($articleObject["contentList"] as $key => $value){
            $contentID = $value;
            $stmt =  $this->sqlConect()->prepare("INSERT INTO tbl_article_content_map WHERE SET articleId = ?, contentId = ?");
            
            $stmt->bind_param("ii", $articleID,$contentID);
            $stmt->execute();

            }
        }
}
?>