   <div class="block">
      <div class="heading">Callender</div>
      <div class="blockwrap">
      <button type=""> Show Callender </button>
      <div class="clearall"></div>
      </div>
   </div>
   <div class="block">
      <div class="heading">Events</div>
      <div class="blockwrap">
      <button type=""> Upcoming Events </button>
      <div class="clearall"></div>
      </div>
   </div>
   <div class="block">
   <?php
      if(isSessionActive()){
         ?>
         <ul>
         <?php if(getDesignationChecked('SA')) {?>
            <li>
               <a href="index.php?page=users">Users Management</a>
            </li>
         <?php } ?>
         </ul>
         <ul>
            <li>
               <a href="index.php?page=categorymanagement">Category Management</a>
            </li>
         </ul>
         <ul>
            <li>
               <a href="index.php?page=articlemanagement">Article Management</a>
            </li>
         </ul>
         <ul>
            <li>
               <a href="index.php?page=contentmanagement">Content Management</a>
            </li>
         </ul>
         <ul>
            <li>
               <a href="index.php?page=digitalcontentmanagement">Digital Content Management</a>
            </li>
         </ul>
         <ul>
            <li>
               <a href="index.php?page=eventmanagement">Event Management</a>
            </li>
         </ul>
         <ul>
            <li>
               <a href="index.php?page=newsmanagement">News Management</a>
            </li>
         </ul>
         
         <?php
      }
   ?>
   </div>