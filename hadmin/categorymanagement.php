<?php
if(!isSessionActive()){
    header("location:./index.php?page=logout");
    exit;
}
include("./classes/categoryClass.php");
include("./classes/articleClass.php");

$objCategory = new categoryProcessor();
$objArticle = new articleProcessor();


?>
<h1>Category Management</h1>
<div class="pagewrap">
<a href="./index.php?page=categorymanagement&action=add">Add Category</a>
<?php
$showForm = '';
    if(!empty($_GET) && !empty($_GET["action"]) ){
        switch($_GET["action"]){
            case "add":
            //$saveCategory = $objCategory->SaveAllCategory($_REQUEST);
            $showForm = "add";
            break;
            case "save":
            $saveCategory = $objCategory->saveCategory($_REQUEST);
            $showForm = 'save';
            break;
            case "edit":
            $editCategory = $objCategory->getCategoryDetails($_GET['id']);
            $showForm = "edit";
            break;
            case "update":
            $updateCategory = $objCategory->saveCategory($_REQUEST);
            $showForm = "update";
            break;
        }
    }
    $categoryList = $objCategory->getAllCategory();
    $articleList = $objArticle->getAllArticle();
    if($showForm == "add"){
        ?>

            <form name="addcategory" method="POST" action="./index.php?page=categorymanagement&action=save" >    
            <table>
                        <tr>
                            <td><lable>Category Title</lable></td>
                            <td>
                            <input type="text" name="nodetext" placeholder="Category Title" size="50" autocomplete="off"/>
                            </td>
                        </tr> 
                        <!-- <tr>
                            <td><lable>Category Description</lable></td>
                            <td>
                            <textarea name="nodedesc" placeholder="Category Description" style="width:600px; height:200px;"></textarea>
                            </td>
                        </tr> -->
            
                        <tr>
                            <td><lable>Article List</lable></td>
                            <td>
                            <?php
                            /*
                            //print_r($globalCategoryData["articlelist"]);
                            echo "</pre>";
                            print_r($articleList);
                            echo "</pre>";*/
                            ?>
                            
                            <select name="articleid" id="articleid">
                            <?php
                            foreach ($articleList as $key => $value) {
                                ?>
                                <option value="<?php echo $value->articleId; ?>"><?php echo  $value->articleTitle; ?></option>
                                <?php
                            }
                            ?>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <td><lable>Categoty Type</lable></td>
                            <td>
                            <select name="treetype" id="treetype">
                            <option value="">Type Of Category </option>
                            <?php
                            foreach ($globalCategoryData["categorytype"] as $key => $value) {
                                ?>
                                <option value="<?php echo $key; ?>"><?php echo  $value; ?></option>
                                <?php
                            }
                            ?>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <td><lable>Parent Categoty List</lable></td>
                            <td>
                            <select name="nodeparentid" id="nodeparentid">
                            <option value="">Parent Base Item</option>
                            <?php
                            foreach ($categoryList as $key => $value) {
                                ?>
                                <option value="<?php echo $value->nodeId; ?>"><?php echo  $value->nodeText; ?></option>
                                <?php
                            }
                            ?>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" value="Save"/>
                                <input type="button" name="submit" value="Cancel"/>
                            </td>
                            <td></td>
                        </tr>
            </table>

        </form>
        <?php
    }


    if($showForm == 'edit'){
            //print_r($editCategory);
            ?>
            <form name="editcategory" method="POST" action="./index.php?page=categorymanagement&action=update"> 
                <h2>Edit Category</h2>
                <table>
                        <tr>
                            <td><lable>Category Title</lable></td>
                            <td>
                            <input type="text" name="nodetext" placeholder="Category Title" value="<?php echo $editCategory[0]->nodeText; ?>" size="50" autocomplete="off"/>
                            </td>
                        </tr> 
                        <!-- <tr>
                            <td><lable>Category Description</lable></td>
                            <td>
                            <textarea name="nodedesc" placeholder="Category Description" style="width:600px; height:200px;"><?php // echo $editCategory[0]->nodeDesc; ?></textarea>
                            </td>
                        </tr> -->
            
                        <!--<tr>
                            <td><lable>Article List</lable></td>
                            <td>
                            <select name="articleid" id="articleid">
                            <?php
                            /* foreach ($globalCategoryData["articlelist"] as $key => $value) {
                                $selected = ($editCategory[0]->articleId == $k)?'selected="selected"':"";
                                ?>
                                <option value="<?php echo $key; ?>"><?php echo  $value; ?></option>
                                <?php 
                            } */
                            ?>
                            </select>
                            </td>
                        </tr> -->
                        <tr>
                            <td><lable>Article List</lable></td>
                            <td>
                            <select name="articleid" id="articleid">
                            <?php
                            foreach ($articleList as $key => $value) {
                                ?>
                                <option value="<?php echo $value->articleId; ?>"><?php echo  $value->articleTitle; ?></option>
                                <?php
                            }
                            ?>
                            </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td><lable>Categoty Type</lable></td>
                            <td>
                            <select name="treetype" id="treetype">
                            <option value="">Type Of Category </option>
                            <?php
                            foreach ($globalCategoryData["categorytype"] as $key => $value) {
                                $selected = ($editCategory[0]->treeType == $key)?'selected="selected"':"";
                                ?>
                                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo  $value; ?></option>
                                <?php
                            }
                            ?>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <td><lable>Parent Categoty List</lable></td>
                            <td>
                            <select name="nodeparentid" id="nodeparentid">
                            <option value="">Parent Base Item</option>
                            <?php
                            
                            foreach ($categoryList as $key => $value) {
                                $selected = ($editCategory[0]->nodeParentId == $value->nodeId)?'selected="selected"':"";
                                ?>
                                <option <?php echo $selected; ?> value="<?php echo $value->nodeId; ?>"><?php echo  $value->nodeText; ?></option>
                                <?php
                            }
                            ?>
                            </select>
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
            <th>Category Title</th>
            <!-- <th>Category Description</th> -->
            <th>Article List</th>
            <th>Categoty Type</th>
            <th>Parent Categoty List</th>
            <th>Action</th>
        </tr>
        <?php
            foreach($categoryList as $key=>$value) {
                ?>
        <tr>
            <td><?php echo $key+1;?></td>
            <td><?php echo $value->nodeText; ?></td>
            <!-- <td> <?php //echo $value->nodeDesc; ?></td> -->
            <td><?php echo $value->articleId; ?></td>
            <td><?php echo $value->treeType; ?></td>
            <td><?php echo $value->nodeParentId; ?></td>
            <td><a href="./index.php?page=categorymanagement&action=edit&id=<?php echo $value->nodeId; ?>">Edit</a></td>
        </tr><?php 
        }   
        ?>
    </table>
</div>