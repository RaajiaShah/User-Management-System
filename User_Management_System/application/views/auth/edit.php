<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/responsive.css'); ?>" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand user-management-link" href="#">
                <i class="fas fa-users mr-2"></i> User Management
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('dashboard'); ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="<?php echo site_url('auth/logout'); ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Edit Section -->
    <div class="container mt-5">
        <!-- Section Heading -->
        <div class="row justify-content-center mt-5 mb-4">
            <div class="col-md-8 text-center">
                <h2 class="font-weight-bold">Update Your Profile</h2>
                <p class="text-muted">
                    Keep your profile up-to-date to ensure all information is accurate and secure. Fill in the details below to make any changes.
                </p>
            </div>
        </div>

        <!-- Main Edit Form -->
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <!-- Display Flashdata Error -->
                <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('error'); ?>
                </div>
                <?php endif; ?>

                <div class="card shadow-lg">
                    <div class="card-header text-center">
                        <h4>Edit Your Profile</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= site_url('dashboard/edit'); ?>" method="post">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-success text-white">
                                            <i class="fas fa-user text-white"></i>
                                        </span>
                                    </div>
                                    <input type="text" id="username" name="username" class="form-control" value="<?= $user->username; ?>" required>
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <label for="email">Email Address</label>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-success text-white">
                                            <i class="fas fa-envelope text-white"></i>
                                        </span>
                                    </div>
                                    <input type="email" id="email" name="email" class="form-control" value="<?= $user->email; ?>" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-block mt-4">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="footer text-center py-3 mt-5">
        <p>
            &copy; <?php echo date("Y"); ?> User Management System. All Rights Reserved.
        </p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Custom JS -->
    <script src="<?php echo base_url('assets/js/script.js'); ?>"></script>
</body>
</html>