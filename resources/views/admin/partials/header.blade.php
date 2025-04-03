<header class="admin-header">
    <div class="header-left">
        <button class="sidebar-toggle">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    
    <div class="header-right">
        <div class="admin-profile">
            <img src="{{ Auth::user()->avatar ?? asset('images/default-avatar.png') }}" alt="Admin Avatar">
            <span>{{ Auth::user()->name }}</span>
            <i class="fas fa-chevron-down"></i>
            
            <div class="profile-dropdown">
                <a href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </div>
        </div>
    </div>
</header>