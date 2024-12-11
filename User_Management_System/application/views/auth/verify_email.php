<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Registration Section -->
    <div class="container mt-5 mb-5">
        <!-- Main Registration Form -->
        <div class="row justify-content-center align-items-center mt-5 mb-5">
            <div class="col-md-6">
                <div class="col-md-12">
                    <div class="card shadow-lg">
                        <div class="card-header text-center">
                            <h4>Email Verification</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?= site_url('auth/verify_email'); ?>" method="POST">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                                </div>
                                <div class="form-group">
                                    <label for="verification_code">Verification Code</label>
                                    <input type="text" name="verification_code" id="verification_code" class="form-control" placeholder="Enter the code sent to your email" required>
                                </div>
                                <button type="submit" class="btn btn-success btn-block">Verify Email</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
    
    
      <!-- Footer -->
    <footer class="footer text-center py-3 mt-5 mb-0">
        <p>
            &copy; <?php echo date("Y"); ?> User Management System. All Rights Reserved.
        </p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo base_url('assets/js/script.js'); ?>"></script>
</body>
</html>