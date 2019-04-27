<div class="be-left-sidebar">
    <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle">{{env('APP_NAME',"Mentor Me Program")}}</a>
        <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
                <div class="left-sidebar-content">
                    <ul class="sidebar-elements">
                        @if(in_array($auth->type, ["super_user","admin","editor","technical","chief_editor"]))
                        <li class="divider">Content Management</li>
                        <li class="parent"><a href="#"><i class="icon mdi mdi-attachment"></i><span>Articles</span></a>
                            <ul class="sub-menu">
                                <li><a href="{{route('system.article.pending')}}">Pending for Approval</a> </li>
                                <li><a href="{{route('system.article.published')}}">Published</a> </li>
                                <li><a href="{{route('system.article.index')}}">All records</a> </li>
                                <li><a href="{{route('system.article.create')}}">Add new article</a> </li>
                            </ul>
                        </li>
                        @endif

                       


                        @if(in_array($auth->type, ["super_user","admin"]))

                        <li class="divider">Account Management</li>
                        <li class="parent"><a href="#"><i class="icon mdi mdi-face"></i><span>System Accounts</span></a>
                            <ul class="sub-menu">
                                <li><a href="{{route('system.user.index')}}">All records</a> </li>
                                <li><a href="{{route('system.user.create')}}">Add new account</a> </li>
                            </ul>
                        </li>
                        @endif

                        @if(in_array($auth->type, ['account_officer']))
                        <li class="divider">Account Management</li>
                        <li class="parent"><a href="#"><i class="icon mdi mdi-accounts-list"></i><span>App Users</span></a>
                            <ul class="sub-menu">
                                <li><a href="{{route('system.app_user.mentor')}}">Mentors</a> </li>
                            </ul>
                        </li>
                        @endif

                        @if(in_array($auth->type, ["super_user","admin","technical","chief_editor"]))

                        <li class="divider">Mastefile</li>
                        <li><a href="{{route('system.page.index')}}"><i class="icon mdi mdi-assignment-o"></i><span>Pages</span></a> </li>
                        <li class="parent"><a href="#"><i class="icon mdi mdi-collection-folder-image"></i><span>File Manager</span></a>
                            <ul class="sub-menu">
                                <li><a href="{{route('system.file.index')}}">All records</a> </li>
                                <li><a href="{{route('system.file.create')}}">Add new file</a> </li>
                            </ul>
                        </li>
                        @if(in_array($auth->type, ["super_user","admin","technical"]))

                        <li class="parent"><a href="#"><i class="icon mdi mdi-collection-text"></i><span>Article Categories</span></a>
                            <ul class="sub-menu">
                                <li><a href="{{route('system.category.index')}}">All records</a> </li>
                                <li><a href="{{route('system.category.create')}}">Add new category</a> </li>
                            </ul>
                        </li>
                        @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>