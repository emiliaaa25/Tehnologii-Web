<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: http://localhost/ProiectMVC/app/views/Login.php'); // Redirect to the login page
    exit;
}

require_once '../controllers/UserController.php';
$userController = new UserController();

$userController->addIdColumnToScreenActorGuildAwards();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <link rel="stylesheet" href="http://localhost/ProiectMVC/public/css/admin.css">
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/ProiectMVC/public/pictures/icon.jpg">
    <style>
        
        .scrollable-table-container {
            max-height: 50vh;
            overflow-y: auto;
            margin-bottom: 20px;
        }
        .pagination-controls {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .form-container {
            margin-bottom: 20px;
        }
        .form-container input, .form-container button {
            margin-right: 10px;
        }

        /* New styles for form inputs and buttons */
        .form-container input[type=text], 
        .form-container input[type=email], 
        .form-container input[type=password] {
            background-color: black;
            border: 1px solid goldenrod;
            color: goldenrod;
            padding: 8px;
            margin-bottom: 10px;
        }
        .form-container button[type=submit] {
            background-color: black;
            border: 1px solid goldenrod;
            color: goldenrod;
            padding: 8px 20px;
            cursor: pointer;
        }
        .form-container button[type=submit]:hover {
            background-color: goldenrod;
            color: black;
        }
        /* New style for labels */
        .form-container label {
            color: goldenrod;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <header>
    <div class="search-bar" id="searchBar">
        <button class="dissmis" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/arrow.png" alt=""></button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'" class="search-barr">Home Page</button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'" class="search-barr">Actors</button>
        <button onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'" class="search-barr">Years</button>
    </div>

    <div class="section-1">
        <div class="title">Actors Awards</div>
        <div class="button-group">
            <div class="search-container">
                <form action="#" method="get">
                    <input type="text" name="search" placeholder="Search...">
                    <button type="submit" class="search-container">
                        <img src="http://localhost/ProiectMVC/public/pictures/search.png" alt="Search" style="width: 30px; height: 30px;">
                    </button>
                </form>
            </div>
            <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/home/HomePage.php'"><strong>HomePage</strong></button>
            <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Actori.php'">Actors</button>
            <button class="button" onclick="window.location.href='http://localhost/ProiectMVC/app/views/Years.php'">Years</button>
            <button class="button border" onclick="toggleSearchBar()"><img src="http://localhost/ProiectMVC/public/pictures/3arrows.jpg" alt=""></button>
        </div>
    </div>
    </header>

    <!-- USERS TABLE -->
    <div class="user-table">
        <h2>USERS TABLE</h2>
        <div class="pagination-controls">
            <button id="prevUsers">Previous</button>
            <button id="nextUsers">Next</button>
        </div>
        <div class="scrollable-table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody">
                    <!-- Data will be loaded here -->
                </tbody>
            </table>
        </div>
        <div class="form-container">
            <form id="addUserForm">
                <label for="firstname">Nume:</label>
                <input type="text" id="firstname" name="firstname" required>
                <label for="lastname">Prenume:</label>
                <input type="text" id="lastname" name="lastname" required>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Parolă:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Adaugă Utilizator</button>
            </form>
        </div>
    </div>

    <!-- SCREEN ACTOR GUILD AWARDS TABLE -->
    <div class="user-table">
        <h2>SCREEN ACTOR GUILD AWARDS</h2>
        <div class="pagination-controls">
            <button id="prevAwards">Previous</button>
            <button id="nextAwards">Next</button>
        </div>
        <div class="scrollable-table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Year</th>
                        <th>Category</th>
                        <th>Show</th>
                        <th>Full Name</th>
                        <th>Won</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="awardsTableBody">
                    <!-- Data will be loaded here -->
                </tbody>
            </table>
        </div>
        <div class="form-container">
            <form id="addAwardForm">
                <label for="year">Year:</label>
                <input type="text" id="year" name="year" required>
                <label for="category">Category:</label>
                <input type="text" id="category" name="category" required>
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" required>
                <label for="won">Won:</label>
                <input type="text" id="won" name="won" required>
                <button type="submit">Adaugă Award</button>
            </form>
        </div>
    </div>

    <button onclick="window.location.href='http://localhost/ProiectMVC/public/index.php?action=logout'" type="submit-login">Logout</button>

    <script>
        console.log("Script loaded");

        let userPage = 1;
        let awardPage = 1;
        const pageSize = 10;

        document.getElementById('addUserForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = {
                firstname: document.getElementById('firstname').value,
                lastname: document.getElementById('lastname').value,
                username: document.getElementById('username').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value
            };

            fetch('http://localhost/ProiectMVC/public/index.php?action=addUser', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Utilizatorul a fost adăugat cu succes!');
                    // Poți adăuga alte acțiuni aici după adăugarea cu succes a utilizatorului
                    // De exemplu, curățarea formularului sau redirecționarea către o altă pagină
                } else {
                    alert('Adăugarea utilizatorului a eșuat.');
                    // Poți adăuga alte acțiuni aici în caz de eroare
                }
            })
            .catch(error => {
                console.error('Eroare în timpul adăugării utilizatorului:', error);
                alert('A apărut o eroare în timpul adăugării utilizatorului.');
            });
        });

        document.getElementById('addAwardForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = {
                year: document.getElementById('year').value,
                category: document.getElementById('category').value,
                full_name: document.getElementById('full_name').value,
                won: document.getElementById('won').value
            };

            fetch('http://localhost/ProiectMVC/public/index.php?action=addAward', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Award a fost adăugat cu succes!');
                    // Poți adăuga alte acțiuni aici după adăugarea cu succes a award-ului
                    // De exemplu, curățarea formularului sau redirecționarea către o altă pagină
                } else {
                    alert('Adăugarea award-ului a eșuat.');
                    // Poți adăuga alte acțiuni aici în caz de eroare
                }
            })
            .catch(error => {
                console.error('Eroare în timpul adăugării award-ului:', error);
                alert('A apărut o eroare în timpul adăugării award-ului.');
            });
        });

        function loadUsers() {
            console.log("Loading users, page:", userPage);
            fetch(`http://localhost/ProiectMVC/public/index.php?action=getUsers&page=${userPage}&pageSize=${pageSize}`)
                .then(response => response.json())
                .then(data => {
                    const usersTableBody = document.getElementById('usersTableBody');
                    usersTableBody.innerHTML = ''; // Clear existing data
                    data.users.forEach(user => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${user.id}</td>
                            <td>${user.firstname}</td>
                            <td>${user.lastname}</td>
                            <td>${user.username}</td>
                            <td>${user.email}</td>
                            <td>
                                <form action="http://localhost/ProiectMVC/public/index.php?action=deleteUser" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="${user.id}">
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        `;
                        usersTableBody.appendChild(row);
                    });
                    document.getElementById('prevUsers').disabled = userPage <= 1;
                    document.getElementById('nextUsers').disabled = data.users.length < pageSize;
                })
                .catch(error => console.error('Error loading users:', error));
        }

        function loadAwards() {
            console.log("Loading awards, page:", awardPage);
            fetch(`http://localhost/ProiectMVC/public/index.php?action=getAwards&page=${awardPage}&pageSize=${pageSize}`)
                .then(response => response.json())
                .then(data => {
                    const awardsTableBody = document.getElementById('awardsTableBody');
                    awardsTableBody.innerHTML = ''; // Clear existing data
                    data.awards.forEach(award => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${award.id}</td> <!-- Display ID -->
                            <td>${award.year}</td>
                            <td>${award.category}</td>
                            <td>${award.show}</td>
                            <td>${award.full_name}</td>
                            <td>${award.won}</td>
                            <td>
                                <form action="http://localhost/ProiectMVC/public/index.php?action=deleteAward" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="${award.id}">
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        `;
                        awardsTableBody.appendChild(row);
                    });
                    document.getElementById('prevAwards').disabled = awardPage <= 1;
                    document.getElementById('nextAwards').disabled = data.awards.length < pageSize;
                })
                .catch(error => console.error('Error loading awards:', error));
        }


        function toggleSearchBar() {
            const searchBar = document.getElementById('searchBar');
            searchBar.classList.toggle('hidden');
        }

        // Event listeners for pagination buttons
        document.getElementById('prevUsers').addEventListener('click', () => {
            if (userPage > 1) {
                userPage--;
                loadUsers();
            }
        });

        document.getElementById('nextUsers').addEventListener('click', () => {
            userPage++;
            loadUsers();
        });

        document.getElementById('prevAwards').addEventListener('click', () => {
            if (awardPage > 1) {
                awardPage--;
                loadAwards();
            }
        });

        document.getElementById('nextAwards').addEventListener('click', () => {
            awardPage++;
            loadAwards();
        });

        // Load initial data
        loadUsers();
        loadAwards();
    </script>
</body>
</html>
