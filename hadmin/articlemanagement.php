<?php
if(!isSessionActive()){
    header("location:./index.php?page=logout");
    exit;
}
include("./classes/articleClass.php");
$objArticle = new articleProcessor();

?>

<h1>Article Management</h1>

<div class="pagewrap">
<a href="./index.php?page=articlemanagement&action=add">Add Article</a>
<?php
$showForm = '';
    if(!empty($_GET) && !empty($_GET["action"]) ){
        switch($_GET["action"]){
            case "add":
            //$saveArticle = $objArticle->SaveAllArticle($_REQUEST);
            $showForm = "add";
            break;
            case "save":
            $saveArticle = $objArticle->saveArticle($_REQUEST);
            $showForm = 'save';
            break;
            case "edit":
            $editArticle = $objArticle->getArticleDetails($_GET['id']);
            $showForm = "edit";
            break;
            case "update":
            $updateArticle = $objArticle->saveArticle($_REQUEST);
            $showForm = "update";
            break;
        }
    }
    $articleList = $objArticle->getAllArticle();
    if($showForm == "add"){
        ?>

            <form name="addarticle" method="POST" action="./index.php?page=articlemanagement&action=save" >    
            <table>
                        <tr>
                            <td><lable>Article Title:</lable></td>
                        </tr>
                        <tr>
                            <td>
                            <input type="text" name="articletitle" placeholder="Article Title" size="50" autocomplete="off"/>
                            </td>
                        </tr>
                        <tr>
                            <td><lable>Article Type:</lable></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="articletype" id="articletype" >
                                <?php
                                foreach ($globalArticleData["articletype"] as $key => $value) {
                                    ?>
                                    <option value="<?php echo $key; ?>"><?php echo  $value; ?></option>
                                    <?php
                                }
                                ?>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td><lable for="startdate">From Date:</lable></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="date" id="fromdate" name="fromdate"/>
                            </td>
                        </tr>
                        <tr>
                            <td><lable for="enddate">To Date:</lable></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="date" id="todate" name="todate"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="submit" value="Save"/>
                                <input type="button" name="submit" value="Cancel"/>
                            </td>
                        </tr>
            </table>

        </form>
        <?php
    }

    if($showForm == 'edit'){
            //print_r($editArticle);
            ?>
            <form name="editarticle" method="POST" action="./index.php?page=articlemanagement&action=update"> 
                <h2>Edit Article</h2>

                <table>
                        <tr>
                            <td><lable>Article Title:</lable></td>
                        </tr>
                        <tr>
                            <td>
                            <input type="text" name="articletitle" placeholder="Article Title"
                            value="<?php echo $editArticle[0]->articleTitle; ?>" size="50" autocomplete="off"/>
                            </td>
                        </tr>
                        <tr>
                            <td><lable>Article Type:</lable></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="articletype" id="articletype" >
                                <?php
                                foreach ($globalArticleData["articletype"] as $key => $value) {
                                    ?>
                                    <option value="<?php echo $key; ?>"><?php echo  $value; ?></option>
                                    <?php
                                }
                                ?>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td><lable for="startdate">From Date:</lable></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="date" id="fromdate" name="fromdate"/>
                            </td>
                        </tr>
                        <tr>
                            <td><lable for="enddate">To Date:</lable></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="date" id="todate" name="todate"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit"> Update </button>
                                <input type="hidden" name="submitaddForm" value="submit"/>
                                <input type="hidden" name="editID" value="<?php echo $_GET["id"];?>"/>
                                <button type="cancel"> Cancel </button>
                            </td>
                        </tr>
            </table>

        </form>
                <?php
        }

?>
<table cellspacing="0" cellpadding="0" width="100%" border="1">
        <tr>
            <th>#</th>
            <th>Article Title</th>
            <th>Article Type</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Action</th>
        </tr>
        <?php
            foreach($articleList as $key=>$value) {
                ?>
        <tr>
            <td><?php echo $key+1;?></td>
            <td><?php echo $value->articleTitle; ?></td>
            <td><?php echo $globalArticleData["articletype"][$value->articleType]; ?></td>
            <td><?php echo $value->fromDate; ?></td>
            <td><?php echo $value->toDate; ?></td>
            <td><a href="./index.php?page=articlemanagement&action=edit&id=<?php echo $value->articleId; ?>">Edit</a></td>
        </tr><?php 
        }   
        ?>
    </table>
</div>