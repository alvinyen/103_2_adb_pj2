
			哈囉
			
			<?php 
				if ( isset($_SESSION['MemName']) )
				{
					echo $_SESSION['MemName']."，<br>歡迎使用Library<br>";
				}
				else if ( isset($_SESSION['EmpName']) )
				{
					echo $_SESSION['EmpName']."，<br>歡迎使用Library<br>";
				}
				else
				{
					echo "～您尚未登入！<br>";?>
					新會員請<a href="register.php">點我註冊</a><br>
				<?php
				}
			?>
