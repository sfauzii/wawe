<!-- Navbar section start -->
<nav>
    <div class="search-container">
        <input type="text" placeholder="Search...">
        <button>
            <span class="material-icons">search</span>
            <!-- <img src="frontend/images/icons/search-normal.png" alt="Members Icon" class="search-icon"> -->
        </button>
    </div>
    <div class="toggle-btn" id="toggle_btn">
        <span class="material-icons">menu</span>
    </div>

    <div class="user" id="user_dropdown">
        <span style="color: black;">S Fauzi</span>
        <img src="{{ url('frontend/images/member.png') }}" alt="Profile Picture" class="profile-image" style="cursor: pointer;" onclick="toggleDropdown()">
        <div class="dropdown-content" id="dropdown_content">
            <!-- Dropdown items here -->
            <a href="#">Profile</a>
            <a href="#">Settings</a>
            <hr>
            <a href="login.html">Logout</a>
        </div>
    </div>
</nav>
<!-- Navbar section end -->