
<?php
include_once("./classes/applicationClass.php");

class categoryProcessor extends applicationProcessor{

        function getAllCategory(){
        //echo "all Category List Printed";
            $mysqli_query = "select nodeId, nodeParentId, nodeText, nodeDesc, articleId,treeType from tbl_nodetree";

            $result1 = $this->sqlConect()->query($mysqli_query);
            $resultsArr = array();
            if ($result1){
            while($categoryObj = $result1->fetch_object()){
                array_push($resultsArr, $categoryObj);
            }

            //echo $result1->num_rows;

            return $resultsArr;
            }
    }

        function getCategoryDetails($nodeID){

                $mysqli_query2 = "select * from tbl_nodetree where nodeId = ".$nodeID;
                    
                    $result3 = $this->sqlConect()->query($mysqli_query2);
                    $resultsArr2 = array();
                    if ($result3){
                    while($categoryObj = $result3->fetch_object()){
                        array_push($resultsArr2, $categoryObj);
                    }
                }

                    return $resultsArr2;
            }



        public function saveCategory($categoryObject){
            if(!empty($categoryObject['editID'])){
                    $this->updateCategory($categoryObject);
            }else{
                    $this->addCategory($categoryObject);
                }
        }
        private function addCategory($categoryObject){
            //print_r($categoryObject);
            
            $nodeParentId = (!empty($categoryObject['nodeparentid']))?$categoryObject['nodeparentid']:1;
            $nodeText = $categoryObject['nodetext'];
            # $nodeDesc = $categoryObject['nodedesc'];
            $articleId = $categoryObject['articleid'];
            $treeType = $categoryObject['treetype'];

            // prepare and bind
            $stmt =  $this->sqlConect()->prepare("INSERT INTO tbl_nodetree (nodeParentId, nodeText, articleId,treeType) VALUES (?,?,?,?)");
            
            $stmt->bind_param("isis", $nodeParentId, $nodeText, $articleId, $treeType);
            print_r($stmt);

            $stmt->execute();

            echo "New records created successfully";

            $stmt->close(); 
            
        }
        function updateCategory($categoryObject){
            //print_r($categoryObject);

            /*echo $nodeparentid = $categoryObject['nodeparentid'];
            echo $nodetext = $categoryObject['nodetext'];
            echo $nodedesc = $categoryObject['nodedesc'];
            echo $articleid = $categoryObject['articleid'];
            echo $treetype = $categoryObject['treetype'];
            echo $editID   = $categoryObject['id'];
            // prepare and bind
            echo $stmt =  $this->sqlConect()->prepare("UPDATE tbl_nodetree SET (nodeParentId, nodeText, nodeDesc, articleId,treeType) VALUES (?,?,?,?,?) where nodeId = ?");
            echo $stmt->bind_param("issisi", $nodeParentId, $nodeText, $nodeDesc,$articleId,$treeType,$editID);
            $stmt->execute();

            echo "New records Updated successfully";

            $stmt->close(); */        
            
            $nodeparentid = $categoryObject['nodeparentid'];
            $nodetext = $categoryObject['nodetext'];
            #$nodedesc = $categoryObject['nodedesc'];
            $articleid = $categoryObject['articleid'];
            $treetype = $categoryObject['treetype'];
            $sqlStr = "";
            $sqlArr = array();
            
            if(!empty($categoryObject['nodeparentid'])){
                array_push($sqlArr," nodeParentId = '".$nodeparentid."'");
            }
            if(!empty($categoryObject['nodetext'])){

                array_push($sqlArr,"nodeText = '".$nodetext."'");
            }
            if(!empty($categoryObject['nodedesc'])){
                array_push($sqlArr,"nodeDesc = '".$nodedesc."'");
            }
            if(!empty($categoryObject['articleid'])){
                array_push($sqlArr,"articleId = '".$articleid."'");
            }
            if(!empty($categoryObject['treetype'])){
                array_push($sqlArr,"treeType = '".$treetype."'");
            }

            $sqlStr = implode($sqlArr,", ");
            
            $mysqli_query = " update tbl_nodetree set ".$sqlStr." where nodeId = ".$categoryObject['editID'];
            
            $this->sqlConect()->query($mysqli_query);
            
        }
    }
?>