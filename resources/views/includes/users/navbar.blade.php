<!-- Navbar section start -->
<nav>

    @livewire('search-nav')

    {{-- <div class="search-container">
        <input type="text" placeholder="Search...">
        <button>
            <span class="material-icons">search</span>
            <!-- <img src="frontend/images/icons/search-normal.png" alt="Members Icon" class="search-icon"> -->
        </button>
    </div> --}}

    <div class="toggle-btn" id="toggle_btn">
        <span class="material-icons">menu</span>
    </div>

    <div class="user" id="user_dropdown">
        <span style="color: black;">Hi, {{ ucfirst(Auth::user()->name) }}</span>
        <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . Auth::user()->name }}"
            alt="Profile Picture {{ Auth::user()->name }}" class="profile-image" style="cursor: pointer;"
            onclick="toggleDropdown()">
        <div class="dropdown-content" id="dropdown_content">
            <!-- Dropdown items here -->
            <a href="{{ route('overview', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}">Overview</a>
            <a href="{{ route('my-ticket', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}">My Ticket</a>
            <a href="{{ route('settings', ['username' => Auth::user()->username, 'id' => Auth::id()]) }}">Settings</a>
            <div class="dropdown-divider"></div>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</nav>
<!-- Navbar section end -->
