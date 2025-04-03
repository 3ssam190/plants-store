<aside class="admin-sidebar">
    <div class="sidebar-brand">
        <h2><i class="fas fa-leaf"></i> Plants Admin</h2>
    </div>
    
    <nav class="sidebar-nav">
        <ul>
            <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="{{ request()->is('admin/plants*') ? 'active' : '' }}">
                <a href="{{ route('admin.plants.index') }}">
                    <i class="fas fa-seedling"></i> Plants
                </a>
            </li>
            <li class="{{ request()->is('admin/orders*') ? 'active' : '' }}">
                <a href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-shopping-cart"></i> Orders
                </a>
            </li>
            <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users"></i> Users
                </a>
            </li>
        </ul>
    </nav>
</aside>