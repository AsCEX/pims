
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?php foreach($menu as $m): $ids = explode("|", $m['id']); ?>
                <li class="treeview <?php echo ( in_array($class, $ids)  ) ? "active":""; ?>">
                    <a href="#">
                        <i class="fa <?php echo $m['icon_class']; ?>"></i> <span><?php echo $m['label']; ?></span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php foreach($m['items'] as $item): ?>
                            <li class="<?php echo ($item['id'] == $class) ? "active": ""; ?>">
                                <a href="<?php echo $item['url']; ?>">
                                    <i class="fa fa-circle-o"></i>
                                    <?php echo $item['label']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
<?php /*

            <li class="treeview">
                <a href="#">
                    <i class="fa fa fa-calendar"></i> <span>Procurement Plans</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo site_url('procurement_plan'); ?>"> View PPMP</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-alt"></i> <span>Purchase Request</span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo site_url('purchased_request'); ?>"> View PR</a></li>
                    <li><a href="<?php echo site_url('purchased_request/create'); ?>"> Add Request</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-th-list"></i> <span>Purchase Order</span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo site_url('purchased_order'); ?>"> View PO</a></li>
                    <li><a href="<?php echo site_url('purchased_order/create'); ?>"> Add PO</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>Delivery</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/charts/chartjs.html"> View Deliveries</a></li>
                    <li><a href="pages/charts/morris.html"> Add Delivery</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Inventory</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/UI/general.html"> General</a></li>
                    <li><a href="pages/UI/icons.html"> Icons</a></li>
                    <li><a href="pages/UI/buttons.html"> Buttons</a></li>
                    <li><a href="pages/UI/sliders.html"> Sliders</a></li>
                    <li><a href="pages/UI/timeline.html"> Timeline</a></li>
                    <li><a href="pages/UI/modals.html"> Modals</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Users</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('users'); ?>"> View Users</a></li>
                    <li><a href="pages/tables/data.html"> Add User</a></li>
                    <li><a href="pages/tables/data.html"> View Groups</a></li>
                    <li><a href="pages/tables/data.html"> Add Group</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>Settings</span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('categories'); ?>"> Categories</a></li>
                    <li><a href="<?php echo site_url('groups'); ?>"> Groups</a></li>
                    <li><a href="<?php echo site_url('suppliers'); ?>"> Suppliers</a></li>
                    <li><a href="<?php echo site_url('offices'); ?>"> Offices</a></li>
                    <li><a href="<?php echo site_url('units'); ?>"> Units</a></li>
                </ul>
            </li> */ ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>