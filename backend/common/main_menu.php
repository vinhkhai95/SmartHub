<!-- Menu start -->
<div id='menu'>
    <ul>
        <li <?= $type == 'dashboard' ? 'class="highlight"' : '' ?>> 
            <a href='index.php' > <i class="fa fa-desktop"></i> <span>Home</span> </a> 
            <?= $type == 'dashboard' ? '<span class="current-page"></span>' : '' ?>
        </li>
        <li class='has-sub'> <a href='#'> <i class="fa fa-flask"></i> <span>Admin Manager</span> </a>
            <ul <?= ($type == 'Admin') ? 'style="display: block"' : '' ?>>
                <li> <a href='index.php?action=admin_add' 
                        <?= ($type == 'admin' && $action == 'add') ? 'class="select"' : '' ?>> <span>Add New Admin</span> </a> </li>
                <li> <a href='index.php?action=admin_list'
                        <?= ($type == 'admin' && $action == 'list') ? 'class="select"' : '' ?>> <span>List All Admins</span> </a> 
                </li>
                <li> <a href="index.php?action=admin_find"
                        <?= ($type == 'admin' && $action == 'find') ? 'class="select"' : '' ?>> <span>Find Admin</span> </a> </li>
            </ul>
        </li>

        <li class='has-sub'> <a href='#'> <i class="fa fa-tasks"></i> <span>User Manager</span> </a>
            <ul <?= ($type == 'user') ? 'style="display: block"' : '' ?>>
                <li> <a href='index.php?action=user_add'
                        <?= ($type == 'user' && $action == 'add') ? 'class="select"' : '' ?>> <span>Add New User</span> </a> </li>
                <li> <a href='index.php?action=user_list'
                        <?= ($type == 'user' && $action == 'list') ? 'class="select"' : '' ?>> <span>List All Users</span> </a> </li>
                <li> <a href='index.php?action=user_find'
                        <?= ($type == 'user' && $action == 'find') ? 'class="select"' : '' ?>> <span>Find User</span> </a> </li>
            </ul>
        </li>

        <li class='has-sub'> <a href='#'> <i class="fa fa-tasks"></i> <span>Room Manager</span> </a>
            <ul <?= ($type == 'lab') ? 'style="display: block"' : '' ?>>
                <li> <a href='index.php?action=lab_add'
                        <?= ($type == 'lab' && $action == 'add') ? 'class="select"' : '' ?>> <span>Add New Room</span> </a> </li>
                <li> <a href='index.php?action=lab_list'
                        <?= ($type == 'lab' && $action == 'list') ? 'class="select"' : '' ?>> <span>List All Room</span> </a> </li>
                <li> <a href='index.php?action=lab_find'
                        <?= ($type == 'lab' && $action == 'find') ? 'class="select"' : '' ?>> <span>Find Room</span> </a> </li>
            </ul>
        </li>   
               
        <li class='has-sub'> <a href='#'> <i class="fa fa-flask"></i> <span>MQTT Configuration</span> </a>
            <ul <?= ($type == 'configuration') ? 'style="display: block"' : '' ?>>
                <li> 
                    <a href='index.php?action=MQTT_edit' 
                        <?= ($type == 'MQTT' && $action == 'edit') ? 'class="select"' : '' ?>> <span>MQTT Parameter</span> </a> 
                </li>
            </ul>
        </li>               
    </ul>
</div>
<!-- Menu End --> 