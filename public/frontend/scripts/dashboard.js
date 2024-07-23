

// const sideMenu = document.querySelector('aside');
// const menuBtn  = document.querySelector('#menu_bar');
// const closeBtn  = document.querySelector('#close_btn');

// const themeToggler  = document.querySelector('.theme-toggler');




// menuBtn.addEventListener('click',()=>{
//     sideMenu.style.display = "block"
// })

// closeBtn.addEventListener('click',()=>{
//     sideMenu.style.display = "none"
// })
// themeToggler.addEventListener('click',()=>{
    
//     document.body.classList.toggle('dark-theme-variables')

//     themeToggler.querySelector('span:nth-child(1)').classList.toggle('active')
//     themeToggler.querySelector('span:nth-child(2)').classList.toggle('active')
// })


// const closeBtn = document.getElementById('close_btn');
// const sidebar = document.querySelector('aside');

// closeBtn.addEventListener('click', () => {
//     sidebar.classList.remove('open');
// });

// Menjalankan kode setelah dokumen HTML selesai dimuat
// document.addEventListener('DOMContentLoaded', function() {
//     // Menangani klik pada tombol toggle untuk sidebar
//     document.getElementById('toggle_btn').addEventListener('click', function() {
//         document.querySelector('aside').classList.toggle('open');
//     });
// });

// document.addEventListener("DOMContentLoaded", function() {
//     const toggleBtn = document.getElementById('toggle_btn');
//     const closeBtn = document.getElementById('close_btn');
//     const sidebar = document.querySelector('aside');

//     toggleBtn.addEventListener('click', function() {
//         sidebar.classList.toggle('open');
//     });

//     closeBtn.addEventListener('click', function() {
//         sidebar.classList.remove('open');
//     });
// });

document.addEventListener("DOMContentLoaded", function() {
    const toggleBtn = document.getElementById('toggle_btn');
    const closeBtn = document.getElementById('close_btn');
    const sidebar = document.querySelector('aside');

    toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('open');
    });

    closeBtn.addEventListener('click', function() {
        sidebar.classList.remove('open');
    });
});

document.querySelectorAll('aside .sidebar a').forEach(link => {
    link.addEventListener('click', function() {
        document.querySelectorAll('aside .sidebar a').forEach(item => item.classList.remove('active'));
        this.classList.add('active');
    });
});

// PAGINATE
document.addEventListener("DOMContentLoaded", function() {
    const table = document.getElementById("order-table");
    const tbody = table.querySelector("tbody");
    const rowsPerPage = 5;
    const rows = Array.from(tbody.querySelectorAll("tr"));
    let currentPage = 1;

    // Fungsi untuk menampilkan data pada halaman tertentu
    function displayRows(page) {
        const startIndex = (page - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;
        rows.forEach((row, index) => {
            if (index >= startIndex && index < endIndex) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    }

    // Fungsi untuk membuat tombol-tombol paginasi
    function createPaginationButtons() {
        const numPages = Math.ceil(rows.length / rowsPerPage);
        const paginationContainer = document.getElementById("pagination-container");
        paginationContainer.innerHTML = "";

        for (let i = 1; i <= numPages; i++) {
            const button = document.createElement("button");
            button.textContent = i;
            button.addEventListener("click", function() {
                currentPage = i;
                displayRows(currentPage);
                updatePaginationButtons();
            });
            paginationContainer.appendChild(button);
        }

        updatePaginationButtons();
    }

    // Memperbarui status tombol-tombol paginasi (aktif atau tidak)
    function updatePaginationButtons() {
        const buttons = document.querySelectorAll(".pagination button");
        buttons.forEach(button => {
            if (parseInt(button.textContent) === currentPage) {
                button.classList.add("active");
            } else {
                button.classList.remove("active");
            }
        });
    }

    // Memanggil fungsi paginasi pertama kali
    displayRows(currentPage);
    // Membuat tombol-tombol paginasi
    createPaginationButtons();
});

// dropdown
// JavaScript to toggle dropdown
function toggleDropdown() {
    var dropdown = document.getElementById("dropdown_content");
    if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
    } else {
        dropdown.style.display = "block";
    }
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.profile-image')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === "block") {
                openDropdown.style.display = "none";
            }
        }
    }
}