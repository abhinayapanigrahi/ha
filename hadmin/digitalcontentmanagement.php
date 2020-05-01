<?php
if(!isSessionActive()){
    header("location:./index.php?page=logout");
    exit;
}
include("./classes/digitalcontentClass.php");
$objDigitalContent = new digitalcontentProcessor();
?>
<h1>Digital Content Management</h1>
<div class="pagewrap">
<a href="./index.php?page=digitalcontentmanagement&action=add">Add Digital Contents</a>
<?php
$showForm = '';
    if(!empty($_GET) && !empty($_GET["action"]) ){
        switch($_GET["action"]){
            case "add":
            $showForm = "add";
            break;
            case "save":
            $saveDigitalContent = $objDigitalContent->saveDigitalContent($_REQUEST,$_FILES);
            $showForm = 'save';
            break;
            case "edit":
            $editDigitalContent = $objDigitalContent->getDigitalContentDetails($_GET['id']);
            $showForm = "edit";
            break;
            }
    }
    $digitalcontentList = $objDigitalContent->getAllDigitalContent();
    if($showForm == "add"){
        ?>

            <form name="adddigitalcontent" method="POST" action="./index.php?page=digitalcontentmanagement&action=save" enctype="multipart/form-data" >
            <table>
                        <tr>
                            <td><lable for="myfile">File Type:</lable></td>
                        </tr>
                        <tr id="selectFile">
                            <td>
                            <input type="file" id="myfile" name="myfile" multiple/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <label for="fileURL">Video URL</label>
                            <input type="text" id="fileURL" name="fileURL" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="submit" value="Save"/>
                                <input type="button" name="Cancel" value="Cancel" onClick="reloadMe()" />
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
            <th>File Type</th>
            <th>File</th>
            <th>Added By</th>
            <th>Added Date</th>
            <th>Action</th>
        </tr>
        <?php
            foreach($digitalcontentList as $key=>$value) {
                ?>
                <tr>
            <td><?php echo $key+1;?></td>
            <td><?php echo $value->fileType; ?></td>
            <td><?php echo $value->filePath; ?></td>
            <td><?php echo $value->fileName; ?></td>
            <td><?php echo $value->uname; ?></td>
            <td><?php echo $value->addedDate; ?></td>
            <td><a href="./index.php?page=digitalcontentmanagement&action=edit&id=<?php echo $value->fileId; ?>">Edit</a></td>
        </tr><?php 
        }   
        ?>
    </table>
</div>