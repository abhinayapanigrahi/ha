<?php
include_once("./classes/applicationClass.php");

class contentProcessor extends applicationProcessor{

    function getAllContent(){
            //echo "all Content List Printed";
            $mysqli_query = "select c.contentId, c.contentTitle, c.content, IF( c.isPublished = 1, 'yes', 'no' ) AS isPublished, c.publishedBy, c.addedBy, c.addedDate, c.isActive, u.userName AS uname from tbl_content AS c LEFT JOIN tbl_user u ON c.addedBy = u.userId";

            $result1 = $this->sqlConect()->query($mysqli_query);
            $resultsArr = array();
            if ($result1){
            while($contentObj = $result1->fetch_object()){
                array_push($resultsArr, $contentObj);
            }

            //echo $result1->num_rows;

            return $resultsArr;
            }
    }

    function getContentDetails($contentID){

            $mysqli_query2 = "select c.contentId, c.contentTitle, c.content, IF( c.isPublished = 1, 'yes', 'no' ) AS isPublished, c.publishedBy, c.addedBy, c.addedDate, c.isActive from tbl_content AS c where contentId = ".$contentID;
                
                $result3 = $this->sqlConect()->query($mysqli_query2);
                $resultsArr2 = array();
                if ($result3){
                while($contentObj = $result3->fetch_object()){
                    array_push($resultsArr2, $contentObj);
                }
            }

                return $resultsArr2;
    }

    public function saveContent($contentObject){
            if(!empty($contentObject['editID'])){
                    $this->updateContent($contentObject);
            }else{
                    $this->addContent($contentObject);
                }
        }
        private function addContent($contentObject){
            //print_r($contentObject);
            
            $contentTitle = $contentObject['contentTitle'];
            $content = $contentObject['content'];
            $isPublished = ($contentObject['ispublished'] == 'yes')?1:0;
            $publishedBy = $this->getPublisherUserID();
            $addedBy = $this->getLogedInUserID();
            $addedDate = 'NOW()';
            $isActive = $contentObject['isactive'];

            // prepare and bind
            //$stmt =  $this->sqlConect()->prepare("INSERT INTO tbl_content (contentTitle, content, isPublished, publishedBy,addedBy,addedDate,isActive) VALUES (?,?,?,?,?,'NOW()',?)");
            $stmt =  $this->sqlConect()->prepare("INSERT INTO tbl_content SET contentTitle = ?, content = ?, isPublished = ?, publishedBy = ?, addedBy = ?, addedDate = NOW(), isActive = ?");
            
            $stmt->bind_param("ssiiii", $contentTitle, $content, $isPublished,$publishedBy,$addedBy,$isActive);
            
            //print_r($stmt);

            $stmt->execute();

            echo "New records created successfully";

            $stmt->close(); 

        }
        private function getLogedInUserID(){
            return ($_SESSION["uid"])?$_SESSION["uid"]:0;
        }
        private function getPublisherUserID(){
            if($_SESSION['desig'] == 'MOD' || $_SESSION['desig'] == 'REV' || $_SESSION['desig'] == 'SA') {
                return ($_SESSION["uid"])?$_SESSION["uid"]:0;
            }else{
                return 0;
            }

        }

        function updateContent($contentObject){

            $contentTitle = $contentObject['contentTitle'];
            $content = $contentObject['content'];
            $isPublished = ($contentObject['ispublished'] == 'yes')?1:0;
            $publishedBy = $this->getPublisherUserID();
            $addedBy = $this->getLogedInUserID();
            $addedDate = 'NOW()';
            $isActive = $contentObject['isactive'];
            $contentID = $contentObject['editID'];

            //$sqlStr = "";
            //$sqlArr = array();
            
            /*if(!empty($contentObject['content_title'])){
                array_push($sqlArr," contentTitle = '".$contentTitle."'");
            }
            if(!empty($contentObject['content'])){

                array_push($sqlArr,"content = '".$content."'");
            }
            if(!empty($contentObject['ispublished'])){
                array_push($sqlArr,"isPublished = '".$isPublished."'");
            }
            if(!empty($contentObject['isactive'])){
                array_push($sqlArr,"isActive = '".$isActive."'");
            } */

            $stmt =  $this->sqlConect()->prepare("UPDATE tbl_content SET contentTitle = ?, content = ?, isPublished = ?, publishedBy = ?,addedBy = ?,addedDate = NOW(),isActive = ? WHERE contentId = ? ");
            
            $stmt->bind_param("ssiiiii", $contentTitle, $content, $isPublished,$publishedBy,$addedBy,$isActive, $contentID);
            
            //print_r($stmt);

            $stmt->execute();

            echo "New records updated successfully";

            $stmt->close();

        }
}
?>
