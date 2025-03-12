<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fa-solid fa-bug"></i>                
    </div>
    <div class="sidebar-brand-text mx-3">{{ env('APP_COMPANY') }} DevOps<sup> v0.1</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Things -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStyringskasser" aria-expanded="true" aria-controls="collapseThings">
    <i class="fa-solid fa-network-wired"></i>
        <span>Gallerier</span>
    </a>
    <div id="collapseStyringskasser" class="collapse" aria-labelledby="thingsUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Galleri og Token:</h6>
            @can('gallery-list') <a class="collapse-item" href="/admin">Gallerier</a> @endcan
            @can('token-list')<a class="collapse-item" href="/admin/tokens">Tokens</a>@endcan
        </div>
    </div>
</li>

<!-- User and Security -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
    <i class="fa-solid fa-shield"></i>        
    <span>Bruger & sikkerhed</span>
    </a>
    
    <div id="collapseUser" class="collapse" aria-labelledby="userUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Bruger og sikkerhed:</h6>
            <!-- Only show this link if the user has the 'user-list' permission -->
            @can('user-list') <a class="collapse-item" href="/users">Brugere</a> @endcan
            <!-- Only show this link if the user has the 'role-list' permission -->
            @can('role-list') <a class="collapse-item" href="/roles">Roller</a> @endcan
        </div>
    </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>