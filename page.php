<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<title>phpflow.com : Source code of simaple ajax pagination</title>
</head>
<body>
<div><h3>Source code : PHP simaple ajax pagination</h1></div>
<div>
<div id="target-content" >loading...</div>
 
<?php
include('config.php'); 
$limit = 2;
$sql = "SELECT COUNT(msg_id) FROM msg";  
$rs_result = mysqli_query($db,$sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit); 
?>
<div align="center">
<ul class='pagination text-center' id="pagination">
<?php if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
 if($i == 1):?>
            <li class='active'  id="<?php echo $i;?>"><a href='chatPage.php?page=<?php echo $i;?>'><?php echo $i;?></a></li> 
 <?php else:?>
 <li id="<?php echo $i;?>"><a href='chatPage.php?page=<?php echo $i;?>'><?php echo $i;?></a></li>
 <?php endif;?> 
<?php endfor;endif;?>  
</div>
</div>
</body>
<script>
jQuery(document).ready(function() {
jQuery("#target-content").load("chatPage.php?page=1");
    jQuery("#pagination li").live('click',function(e){
 e.preventDefault();
 jQuery("#target-content").html('loading...');
 jQuery("#pagination li").removeClass('active');
 jQuery(this).addClass('active');
        var pageNum = this.id;
        jQuery("#target-content").load("chatPage.php?page=" + pageNum);
    });
    });
</script>