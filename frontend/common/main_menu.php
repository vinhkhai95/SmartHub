<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="index.php?action=home">Main Dashboard</a>
    <a href="index.php?action=ac">AC Dashboard</a>
    <a href="index.php?action=logout">
        <button type="button" class="btn btn-danger">Log out</button>
    </a>
</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
<script>
    function openNav() {
        if(window.innerWidth <= 425){
            document.getElementById("mySidenav").style.width = "100%";
            document.getElementById("main").style.marginLeft = "100%";
        }else{
            document.getElementById("mySidenav").style.width = "200px";
            document.getElementById("main").style.marginLeft = "200px";
        }
    }
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        document.getElementById("main").style.marginLeft= "auto";
    }
</script>