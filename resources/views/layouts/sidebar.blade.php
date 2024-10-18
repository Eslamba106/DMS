<aside class="left-sidebar mt-3">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
              
               
           

               
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="fa fa-users"></i>

                        <span class="hide-menu">{{ __("roles.user_management") }} </span>
                    </a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('admin.user_managment') }}" class="sidebar-link">
                                <i class="mdi mdi-email"></i>
                                <span class="hide-menu">{{ __('roles.all_users') }}</span>
                            </a>
                        </li>
                       
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="fa fa-id-badge"></i>


                        <span class="hide-menu">{{ __("roles.roles") }} </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('admin.roles') }}" class="sidebar-link">
                                <i class="mdi mdi-email"></i>
                                <span class="hide-menu">{{ __('roles.all_roles') }}</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('admin.roles.create') }}" class="sidebar-link">
                                <i class="mdi mdi-email"></i>
                                <span class="hide-menu">{{ __('roles.create_role') }}</span>
                            </a>
                        </li>
                       
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        {{-- <i class="fa fa-id-badge"></i>  --}}
                        <i class="fas fa-tags nav-icon"></i>


                        <span class="hide-menu">{{ __("departments.departments") }} </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('all_departments') }}" class="sidebar-link">
                                <i class="mdi mdi-email"></i>
                                <span class="hide-menu">{{ __('departments.all_departments') }}</span>
                            </a>
                        </li>
                            <li class="sidebar-item">
                                <a href="{{ route('departments.create_department') }}" class="sidebar-link">
                                    <i class="mdi mdi-email"></i>
                                    <span class="hide-menu">{{ __('departments.create_department') }}</span>
                                </a>
                            </li>
                       
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        {{-- <i class="fa fa-id-badge"></i>  --}}
                        <i class="fas fa-tags nav-icon"></i>


                        <span class="hide-menu">{{ __("files.all_files") }} </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('documents.index') }}" class="sidebar-link">
                                <i class="mdi mdi-email"></i>
                                <span class="hide-menu">{{ __('files.all_files') }}</span>
                            </a>
                        </li>
                            <li class="sidebar-item">
                                <a href="{{ route('documents.create') }}" class="sidebar-link">
                                    <i class="mdi mdi-email"></i>
                                    <span class="hide-menu">{{ __('files.create_file') }}</span>
                                </a>
                            </li>
                       
                    </ul>
                </li>
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                            
                        <i class="fas fa-tags nav-icon"></i>


                        <span class="hide-menu">{{ __("folders.all_folders") }} </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('all_departments') }}" class="sidebar-link">
                                <i class="mdi mdi-email"></i>
                                <span class="hide-menu">{{ __('folders.all_folders') }}</span>
                            </a>
                        </li>
                            <li class="sidebar-item">
                                <a href="{{ route('folders.create') }}" class="sidebar-link">
                                    <i class="mdi mdi-email"></i>
                                    <span class="hide-menu">{{ __('folders.create_folders') }}</span>
                                </a>
                            </li>
                       
                    </ul>
                </li> --}}

        
                          
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)
                           " aria-expanded="false">
                        <i class="icon-Add-User"></i>
                        <span class="hide-menu">Users</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="ui-user-card.html" class="sidebar-link">
                                <i class="mdi mdi-account-box"></i>
                                <span class="hide-menu"> User Card </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="pages-profile.html" class="sidebar-link">
                                <i class="mdi mdi-account-network"></i>
                                <span class="hide-menu"> User Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="ui-user-contacts.html" class="sidebar-link">
                                <i class="mdi mdi-account-star-variant"></i>
                                <span class="hide-menu"> User Contact</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('logout') }}" aria-expanded="false">
                        <i class="mdi mdi-directions"></i>
                        <span class="hide-menu">{{ __('login.logout') }}</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>