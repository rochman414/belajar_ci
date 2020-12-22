<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fab fa-free-code-camp"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Belajar CI</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-3">

        <!-- QUERY -->

        <?php

        $role_id = $this->session->userdata('role_id');

        // $queryMenu = "SELECT 'user_menu'.'id','menu'
        //                 FROM 'user_menu' JOIN 'user_access_menu' 
        //                     ON 'user_menu'.'id' = 'user_access_menu'.'menu_id'
        //                 WHERE 'user_access_menu'.'role_id' = $role_id
        //                 ORDER BY `user_access_menu`.`menu_id` ASC

        //             ";
        $this->db->select('user_menu.*');
        $this->db->from('user_menu');
        $this->db->join('user_access_menu', 'user_access_menu.menu_id = user_menu.id');
        $this->db->where('user_access_menu.role_id', $role_id);
        $this->db->order_by('user_access_menu.menu_id', 'ASC');
        $query = $this->db->get();
        $menu = $query->result_array();

        ?>


        <!-- Heading -->
        <?php foreach ($menu as $m) : ?>
            <div class="sidebar-heading">
                <?= $m['menu'] ?>
            </div>

            <!-- Nav Item - Dashboard -->
            <?php

            $menuid = $m['id'];
            $this->db->select('user_sub_menu.*');
            $this->db->from('user_sub_menu');
            $this->db->where('menu_id', $menuid);
            $this->db->where('is_active', 1);
            $submenu = $this->db->get()->result_array();
            ?>
            <?php foreach ($submenu as $sub) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url($sub['url']); ?>">
                        <i class="<?= $sub['icon']; ?>"></i>
                        <span><?= $sub['title']; ?></span></a>
                </li>
            <?php endforeach; ?>
            <!-- Divider -->
            <hr class="sidebar-divider">
        <?php endforeach; ?>
        <!-- Divider -->

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->