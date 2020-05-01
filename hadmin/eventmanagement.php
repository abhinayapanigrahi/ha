<?php
if(!isSessionActive()){
    header("location:./index.php?page=logout");
    exit;
}
include("./classes/eventClass.php");
$objEvent = new eventProcessor();
?>

<h1>Event Management</h1>
<div class="pagewrap">
<a href="./index.php?page=eventmanagement&action=add">Add Events</a>
<?php
$showForm = '';
    if(!empty($_GET) && !empty($_GET["action"]) ){
        switch($_GET["action"]){
            case "add":
            //$saveEvent = $objEvent->SaveAllEvent($_REQUEST);
            $showForm = "add";
            break;
            case "save":
            $saveEvent = $objEvent->saveEvent($_REQUEST);
            $showForm = 'save';
            break;
            case "edit":
            $editEvent = $objEvent->getEventDetails($_GET['id']);
            $showForm = "edit";
            break;
            case "update":
            $updateEvent = $objEvent->saveEvent($_REQUEST);
            $showForm = "update";
            break;
        }
    }

$eventList = $objEvent->getAllEvent();
    if($showForm == "add"){
        ?>

            <form name="addevent" method="POST" action="./index.php?page=eventmanagement&action=save" >    
            <table>
                        <tr>
                            <td><lable>Event Title:</lable></td>
                        </tr>
                        <tr>
                            <td>
                            <input type="text" name="eventTitle" placeholder="Event Title" autocomplete="off"/>
                            </td>
                        </tr> 
                        <tr>
                            <td><lable>Event Description:</lable></td>
                        </tr>
                        <tr>
                            <td>
                            <textarea name="eventdescription" placeholder="Event Description" style="width:900px; height:300px;"></textarea>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <input type="submit" name="submit" value="Save"/>
                                <input type="submit" name="submit" value="Cancel"/>
                            </td>
                        </tr>
            </table>

        </form>
        <?php
    }

        if($showForm == 'edit'){
            //print_r($editEvent);
            ?>
            <form name="editevent" method="POST" action="./index.php?page=eventmanagement&action=update" >    
            <table>
                        <tr>
                            <td><lable>Event Title:</lable></td>
                        </tr>
                        <tr>
                            <td>
                            <input type="text" name="eventTitle" placeholder="Event Title" autocomplete="off"/>
                            </td>
                        </tr> 
                        <tr>
                            <td><lable>Event Description:</lable></td>
                        </tr>
                        <tr>
                            <td>
                            <textarea name="eventdescription" placeholder="Event Description" style="width:900px; height:300px;"></textarea>
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
            <th>Event Title</th>
            <th>Event Description</th>
            <th>Event Location</th>
            <th>Event Organizers</th>
            <th>Gallery Id</th>
            <th>Article Id</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Action</th>
        </tr>
        <?php
        foreach($eventList as $key=>$value) {
                ?>
        <tr>
            <td><?php echo $key+1;?></td>
            <td><?php echo $value->eventTitle; ?></td>
            <td><?php echo $value->eventDescription; ?></td>
            <td><?php echo $value->eventLocation; ?></td>
            <td><?php echo $value->eventOrganizers; ?></td>
            <td><?php echo $value->galleryId; ?></td>
            <td><?php echo $value->articleId; ?></td>
            <td><?php echo $value->fromDate; ?></td>
            <td><?php echo $value->toDate; ?></td>
            
            <td><a href="./index.php?page=eventmanagement&action=edit&id=<?php echo $value->eventId; ?>">Edit</a></td>
        </tr><?php 
        }   
        ?>
    </table>
</div>