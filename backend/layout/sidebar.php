<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="<?php echo STATIC_URL; ?>img/avatar5.png" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>Hello, <?php echo $_SESSION['email']; ?></p>  
        </div>
    </div>   
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
       <li class="treeview active">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Album</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
                <a href="<?php echo BASE_URL; ?>album&act=form">
                    <i class="fa fa-circle-o"></i> <span>Add new</span> <!--<small class="badge pull-right bg-green">new</small>-->            </a>
            </li>
            <li>
                <a href="<?php echo BASE_URL; ?>album&act=list">
                    <i class="fa fa-circle-o"></i> <span>List</span> <!--<small class="badge pull-right bg-green">new</small>-->            </a>
            </li>     
            
          </ul>
        </li>
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Event</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
                <a href="<?php echo BASE_URL; ?>event&act=form">
                    <i class="fa fa-circle-o"></i> <span>Add new</span> <!--<small class="badge pull-right bg-green">new</small>-->            </a>
            </li>
            <li>
                <a href="<?php echo BASE_URL; ?>event&act=list">
                    <i class="fa fa-circle-o"></i> <span>List</span> <!--<small class="badge pull-right bg-green">new</small>-->            </a>
            </li>     
            
          </ul>
        </li>
      <li class="treeview active">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Old Event</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li>
                <a href="<?php echo BASE_URL; ?>old&act=form">
                    <i class="fa fa-circle-o"></i> <span>Add new</span> <!--<small class="badge pull-right bg-green">new</small>-->            </a>
            </li>
            <li>
                <a href="<?php echo BASE_URL; ?>old&act=list">
                    <i class="fa fa-circle-o"></i> <span>List</span> <!--<small class="badge pull-right bg-green">new</small>-->            </a>
            </li>     
            
          </ul>
        </li>
          
    </ul>
</section>
<!-- /.sidebar -->