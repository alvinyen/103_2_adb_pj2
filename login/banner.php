		<div id='cssmenu' style="font-family:Microsoft JhengHei;font-size:250px;">
			<ul>
   				<li><a href='../main.php'>Home</a></li>
   				<li><a href='../reservation/search_1.php'>館藏搜尋</a></li>
   				<li><a href='../myshelf.php'>個人書房</a></li>
               <?php 
               if ( isset($_SESSION['MemID']))
               {
               ?><li><a href='../profile/profile.php'>個人資料</a></li>
               <li><a href='logout.php'>登出</a></li><?php
               }
               else
               {?>
               <li><a href='login.php'>登入</a></li>
               <li><a href='emplogin.php'>員工登入</a></li><?php
               }
               ?>
			</ul>
		</div>
