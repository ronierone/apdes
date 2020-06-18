       <!-- Sidebar -->
       <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

           <!-- Sidebar - Brand -->
           <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
               <div class="sidebar-brand-icon rotate-n-15">
                   <img src="<?= base_url('assets/images/tkj.png') ?>" width="60px" alt="logo.png">
               </div>
               <div class="sidebar-brand-text mx-3">APDES</div>
           </a>

           <!-- Divider -->
           <hr class="sidebar-divider">


           <!-- Query Menu  -->
           <?php
            $role_id = $this->session->userdata('role_id');
            $queryMenu = "SELECT `user_menu`.`id` , `menu` 
                            FROM `user_menu` JOIN `user_access_menu` 
                            ON `user_menu`.`id` = `user_access_menu`.`menu_id` 
                            WHERE `user_access_menu`.`role_id` = $role_id
                            ORDER BY `user_access_menu`.`menu_id` ASC ";


            $menu = $this->db->query($queryMenu)->result_array();

            ?>

           <!-- Looping menu  -->
           <?php foreach ($menu as $m) : ?>
               <div class="sidebar-heading">
                   <?= $m['menu']; ?>
               </div>

               <!-- siapkan submenu sesuai menu  -->
               <?php
                $menuId = $m['id'];
                $querySubMenu = "SELECT * FROM `user_sub_menu`
                                WHERE `menu_id` = $menuId
                                AND `is_active` = 1
                                ";
                $subMenu = $this->db->query($querySubMenu)->result_array();
                ?>

               <?php foreach ($subMenu as $sm) : ?>
                   <li class="nav-item">
                       <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                           <i class="<?= $sm['icon']; ?>"></i>
                           <span><?= $sm['title']; ?></span></a>
                   </li>
               <?php endforeach; ?>

               <hr class="sidebar-divider mt-3">

           <?php endforeach; ?>


           <!-- Nav Item - My Profile -->
           <li class="nav-item">
               <a class="nav-link btn" data-toggle="modal" data-target="#logoutModal">
                   <i class="fas fa-fw fa-sign-out-alt"></i>
                   <span>Logout</span></a>
           </li>
           <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin keluar?</h5>
                           <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">×</span>
                           </button>
                       </div>
                       <div class="modal-body">Klik 'logout' untuk keluar</div>
                       <div class="modal-footer">
                           <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                           <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Logout</a>
                       </div>
                   </div>
               </div>
           </div>
           <!-- Divider -->
           <hr class="sidebar-divider d-none d-md-block">

           <!-- Sidebar Toggler (Sidebar) -->
           <div class="text-center d-none d-md-inline">
               <button class="rounded-circle border-0" id="sidebarToggle"></button>
           </div>

       </ul>
       <!-- End of Sidebar -->