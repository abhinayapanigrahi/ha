<?php
include("./classes/applicationClass.php");

class digitalcontentProcessor extends applicationProcessor{

    function getAllDigitalContent(){

            $mysqli_query = "select d.fileId, d.fileType, d.filePath, d.fileName, d.addedBy, d.addedDate, u.userName AS uname from tbl_digitalcontent AS d LEFT JOIN tbl_user u ON d.addedBy = u.userId";

            //$mysqli_query = "select fileId, fileType, filePath, fileName, addedDate, addedBy from tbl_digitalcontent";

            $result1 = $this->sqlConect()->query($mysqli_query);
            $resultsArr = array();
            if ($result1){
            while($digitalcontentObj = $result1->fetch_object()){
                array_push($resultsArr, $digitalcontentObj);
            }

            //echo $result1->num_rows;

            return $resultsArr;
            }
    }

    function getDigitalContentDetails($fileID){

            $mysqli_query2 = "select d.fileId, d.fileType, d.filePath, d.fileName, d.addedBy, d.addedDate from tbl_digitalcontent AS d where fileId = ".$fileID;
                
                $result3 = $this->sqlConect()->query($mysqli_query2);
                $resultsArr2 = array();
                if ($result3){
                while($digitalcontentObj = $result3->fetch_object()){
                    array_push($resultsArr2, $digitalcontentObj);
                }
            }

                return $resultsArr2;
    }

    public function saveDigitalContent($digitalcontentObject,$fileObject){
            if(!empty($digitalcontentObject['editID'])){
                    $this->updateDigitalContent($digitalcontentObject,$fileObject);
            }else{
                    $this->addDigitalContent($digitalcontentObject,$fileObject);
                }
        }

        private function addDigitalContent($digitalcontentObject,$fileObject){
            
            //print_r($digitalcontentObject);
            print_r($fileObject);
            echo $uploadedFileTpe = $fileObject["myfile"]["type"];
            //which type of file image/pdf/video(How to upload PDF in PHP ? )
            $fileType = $digitalcontentObject['myfile'];
            $URL = $digitalcontentObject['fileURL'];
            
            //$filePath = $digitalcontentObject['filepath'];
            //$fileName = $digitalcontentObject['filename'];
            $addedBy = $this->getLogedInUserID();
            $addedDate = 'NOW()';
            

            // prepare and bind
            
            $stmt =  $this->sqlConect()->prepare("INSERT INTO tbl_digitalcontent SET fileType = ?, filePath = ?, fileName = ?,  addedBy = ?, addedDate = NOW()");
            
            $stmt->bind_param("sssi", $fileType, $filePath, $fileName,$addedBy);
            
            //print_r($stmt);

            $stmt->execute();

            echo "New Records Inserted successfully";

            $stmt->close(); 

        }
        private function getLogedInUserID(){
            return ($_SESSION["uid"])?$_SESSION["uid"]:0;
        }

        function updateDigitalContent($digitalcontentObject){

            $fileType = $digitalcontentObject['myfile'];
            //$filePath = $digitalcontentObject['filepath'];
            //$fileName = $digitalcontentObject['filename'];
            $addedBy = $this->getLogedInUserID();
            $addedDate = 'NOW()';

            $stmt =  $this->sqlConect()->prepare("UPDATE tbl_digitalcontent SET fileType = ?, filePath = ?, fileName = ?,  addedBy = ?, addedDate = NOW() WHERE fileId = ? ");
            
            $stmt->bind_param("sssii", $fileType, $filePath, $fileName,$addedBy, $fileID);
            
            //print_r($stmt);

            $stmt->execute();

            echo "New records updated successfully";

            $stmt->close();

        }
}
?>