<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ATTENDIFY | School Attendance System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/IM/assets/css/style.css">
    <style>
        /* Custom logo sizing */
        .navbar-brand img {
            height: 40px; /* Matches navbar height */
            transition: all 0.3s;
        }
        .navbar-brand:hover img {
            transform: scale(1.05);
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary py-2">
        <div class="container">
            <a class="navbar-brand" href="/IM/">
                <img src="/IM/assets/images/attendify-logo.png" alt="ATTENDiFY" class="me-2">
                
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/IM/students/read.php"><i class="bi bi-people-fill me-1"></i> Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/IM/attendance/mark.php"><i class="bi bi-check-circle-fill me-1"></i> Mark Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/IM/attendance/view.php"><i class="bi bi-list-ul me-1"></i> View Records</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container my-4 flex-grow-1">