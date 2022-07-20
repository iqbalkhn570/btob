<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <?php
          if (!empty(Auth::user()->role_id)) {
            $role_id = Auth::user()->role_id;
          }
                
                
                $roles = DB::select('SELECT * FROM roles WHERE id =' . $role_id);
                $permission_menu = @$roles[0]->permission_menu;
                if ($permission_menu == "") {
                    $permission_menu = 0;
                }
                if ($role_id != 1) {

                    $menus = DB::select('SELECT * FROM menus WHERE parent_id = 0 and status="enabled" and id IN(' . $permission_menu . ') order by position asc');
                } else {
                    $menus = DB::select('SELECT * FROM menus WHERE parent_id = 0 and status="enabled" order by position asc');
                }
                foreach ($menus as $menu) {
                    $check_sub_menu = DB::select('SELECT * FROM menus WHERE status="enabled" and parent_id =' . $menu->id);

                    if (empty($check_sub_menu)) {
                       // echo Request::segment(2);
                        ?>
                        <li class="nav-item ">
                            <a href="{{ route($menu->url) }}" class="nav-link <?php  if(Request::segment(2)==$menu->url) {echo 'active';} ?>">
                                <i class="<?php echo $menu->nav_icon; ?>"></i>
                                <p class="font-weight-light">
                                    
                                    {{ __('messages.'.$menu->title) }}
                                </p>
                            </a>

                        </li>
                        <?php
                    } else {
                        ?>
                        <li class="nav-item menu-<?php  if(Request::segment(2)==$menu->slug) {echo 'open';}else{echo 'close';} ?>">
                            <a href="#" class="nav-link <?php  if(Request::segment(2)==$menu->slug) {echo 'active';} ?>">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    
                                    {{ __('messages.'.$menu->title) }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php
                                foreach ($check_sub_menu as $sub_menu) {
                                    ?>
                                    <li class="nav-item">
                                        <a href="{{ route($sub_menu->url) }}" class="nav-link <?php  if(Request::segment(3)==$sub_menu->slug && Request::segment(2)==$menu->url) {echo 'active';} ?>">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p class="font-weight-light">
                                                
                                                {{ __('messages.'.$sub_menu->title) }}
                                        </p>
                                        </a>
                                    </li>
                                <?php } ?>

                            </ul>
                        </li>
                        <?php
                    }
                }
                ?>
          