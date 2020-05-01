<?php
if(!isSessionActive()){
    header("location:./index.php?page=logout");
    exit;
}
include("./classes/contentClass.php");
$objContent = new contentProcessor();
?>
<h1>Content Management</h1>
<div class="pagewrap">
<a href="./index.php?page=contentmanagement&action=add">Add Contents</a>
<?php
$showForm = '';
    if(!empty($_GET) && !empty($_GET["action"]) ){
        switch($_GET["action"]){
            case "add":
            //$saveContent = $objContent->SaveAllContent($_REQUEST);
            $showForm = "add";
            break;
            case "save":
            $saveContent = $objContent->saveContent($_REQUEST);
            $showForm = 'save';
            break;
            case "edit":
            $editContent = $objContent->getContentDetails($_GET['id']);
            $showForm = "edit";
            break;
            case "update":
            $updateContent = $objContent->saveContent($_REQUEST);
            $showForm = "update";
            break;
        }
    }
    $contentList = $objContent->getAllContent();
    if($showForm == "add"){
        ?>

            <form name="addcontent" method="POST" action="./index.php?page=contentmanagement&action=save" >    
            <table>
                        <tr>
                            <td><lable>Content Title:</lable></td>
                        </tr>
                        <tr>
                            <td>
                            <input type="text" name="contentTitle" placeholder="Content Title" size="50" autocomplete="off"/>
                            </td>
                        </tr> 
                        <tr>
                            <td><lable>Content:</lable></td>
                        </tr>
                        <tr>
                            <td>
                            <textarea name="content" placeholder="Content Description" style="width:800px; height:500px;"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><lable>Is Published:</lable></td>
                        </tr>
                        <tr>
                            <td><label >Yes<input type="radio" id="yes" name="ispublished" value="yes" /></label><label for='no'>No <input type="radio" id="no" name="ispublished" value="no" checked/></label></td>
                        </tr>
                        <tr>
                            <td><lable>Is Active:</lable></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="isactive" id="isactive">
                                <?php
                                foreach ($globalContentData["status"] as $key => $value) {
                                    ?>
                                    <option value="<?php echo $key; ?>"><?php echo  $value; ?></option>
                                    <?php
                                }
                                ?>
                                </select>
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
            //print_r($editContent);
            ?>
            <form name="editcontent" method="POST" action="./index.php?page=contentmanagement&action=update"> 
                <h2>Edit Content</h2>
                <table>
                        <tr>
                            <td><lable>Content Title:</lable></td>
                        </tr>
                        <tr>
                            <td>
                            <input type="text" name="contentTitle" placeholder="Content Title" value="<?php echo $editContent[0]->contentTitle; ?>" size="50" autocomplete="off"/>
                            </td>
                        </tr> 
                        <tr>
                            <td><lable>Content:</lable></td>
                        </tr>
                        <tr>
                            <td>
                            <textarea name="content" placeholder="Content Description" style="width:800px; height:500px;"><?php echo $editContent[0]->content; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td><lable>Is Published:</lable></td>
                        </tr>
                        <tr>
                            <td><?php echo $editContent[0]->isPublished; ?><label >Yes<input type="radio" id="yes" name="ispublished" value="yes" <?php echo ($editContent[0]->isPublished == 'yes')?'checked':''; ?> /></label><label for='no'>No <input type="radio" id="no" name="ispublished" value="no"  <?php echo ($editContent[0]->isPublished == 'no')?'checked':''; ?>/></label></td>
                        </tr>
                        <tr>
                            <td><lable>Is Active:</lable></td>
                        </tr>
                        <tr>
                            <td>
                                <select name="isactive" id="isactive">
                                <?php
                                foreach ($globalContentData["status"] as $key => $value) {
                                    ?>
                                    <option value="<?php echo $key; ?>"><?php echo  $value; ?></option>
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
            <th>Content Title</th>
            <th>Content Description</th>
            <th>Is Published</th>
            <th>Added By</th>
            <th>Added Date</th>
            <th>Is Active</th>
            <th>Action</th>
        </tr>
        <?php
            foreach($contentList as $key=>$value) {
                ?>
        <tr>
            <td><?php echo $key+1;?></td>
            <td><?php echo $value->contentTitle; ?></td>
            <td><?php echo $value->content; ?></td>
            <td><?php echo $value->isPublished; ?></td>
            <td><?php echo $value->uname; ?></td>
            <td><?php echo $value->addedDate; ?></td>
            <td><?php echo $globalContentData["status"][$value->isActive]; ?></td>
            <td><a href="./index.php?page=contentmanagement&action=edit&id=<?php echo $value->contentId; ?>">Edit</a></td>
        </tr><?php 
        }   
        ?>
    </table>
</div>