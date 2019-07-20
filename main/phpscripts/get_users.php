<?php
    
    include_once "../includes/dbh.inc.php";

    $sql = "select * from user_table where name like '%".$_POST['name']."%'
    or surname like '%".$_POST['name']."%'";
    $array = $conn->query($sql);
    
    foreach($array as $key){
        
    ?>

    <div id = "user" style="cursor: pointer;" onclick="goToProfileById(<?php echo($key['id']); ?>)">
        <img onclick="window.open('http://localhost/friendnet/main/profile.php?id=<?php echo $key['id'] ?>', '_self')" width="50" height="50" src="<?php 
            $proPicSearch = $key['profile_pic'];
            if($proPicSearch == "noprofile") {
                $proPicSearch = "uploads/noprofile.png";
            }
            echo $proPicSearch;
         ?>" id = "pic"/>
        &nbsp;<span><?php echo $key['name'] ?> <?php echo $key['surname'] ?></span>
    </div>

<?php
            
    }

?>