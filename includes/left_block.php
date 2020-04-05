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
            <li>
               <a href="index.php?page=users">Users Management</a>
            </li>
         </ul>
         <ul>
            <li>
               <a href="index.php?page=contentmanagement">Content Management</a>
                  <ul style="list-style-type:square;">
                     <li><a href="#">Article</a></li>
                     <li><a href="#">News</a></li>
                     <li><a href="#">Events</a></li>
                     <li><a href="#">Gallery</a></li>
                     <li><a href="#">Detail's Content</a></li>
                  </ul>
            </li>
         </ul>
         
         <?php
      }
   ?>
   </div>