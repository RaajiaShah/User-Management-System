<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('dashboard/edit'); ?>">Edit Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="<?php echo site_url('dashboard/delete'); ?>"
                            onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                            Delete Account
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url('auth/logout'); ?>"
                            onclick="return confirm('Are you sure you want to logout?');">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Dashboard Content -->
    <div class="container mt-5">
        <!-- Welcome Header -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="font-weight-bold">
                    <i class="fas fa-tachometer-alt"></i>
                    Welcome to Your Dashboard,
                    <span class="username-highlight"><?= ucfirst($user->username); ?>!</span>
                </h1>
                <p class="text-muted">
                    Explore features tailored to your needs. Stay tuned for exciting updates and enhancements.
                </p>
                <div class="d-flex justify-content-center align-items-center mt-3">
                    <button class="btn btn-outline-success btn-sm disabled-btn" disabled>
                        <i class="fas fa-lock mr-2"></i> Manage Account (Coming Soon)
                    </button>

                </div>
            </div>
        </div>

        <!-- User Info Card -->
        <div class="row justify-content-center align-items-center mb-4">
            <div class="col-12">
                <div class="card shadow-lg border-success">
                    <div class="card-header text-center bg-success text-white">
                        <h5 class="mb-0 font-weight-bold text-white">User Info</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title text-center font-weight-bold mb-4 text-muted">Your Details</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <span class="d-flex align-items-center">
                                    <i class="fas fa-user mr-2"></i>
                                    <strong>Username:</strong>
                                </span>
                                <span><?= ucfirst($user->username); ?></span>
                            </li>
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <span class="d-flex align-items-center">
                                    <i class="fas fa-envelope mr-2"></i>
                                    <strong>Email:</strong>
                                </span>
                                <span><?= $user->email; ?></span>
                            </li>
                            <li class="list-group-item d-flex align-items-center justify-content-between">
                                <span class="d-flex align-items-center">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <strong>Joined:</strong>
                                </span>
                                <span><?= date('F j, Y', strtotime($user->created_at)); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <!-- Highlight Section -->
        <div class="row mb-4 mt-5">
            <div class="col-12">
                <div class="p-4 rounded bg-light border-left border-success shadow-sm">
                    <h3 class="font-weight-bold mb-3">Exciting Features Ahead!</h3>
                    <p class="text-muted">
                        We're working on bringing you new tools and enhancements to make your experience seamless.
                        Stay tuned for updates like task management, activity tracking, and more personalized support options.
                    </p>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-bullhorn fa-2x mr-3"></i>
                        <span class="font-italic text-muted">"Your feedback helps us grow!"</span>
                    </div>
                </div>
            </div>
        </div>


        <!-- Additional Content Section -->
        <div class="row mt-5">

            <!-- Quick Actions -->
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-sm border-success">
                    <div class="card-body">
                        <i class="fas fa-tasks fa-3x mb-3"></i>
                        <h5 class="card-title font-weight-bold">Quick Actions</h5>
                        <p class="text-muted">
                            Stay tuned! Features like task management will be available soon.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-sm border-success">
                    <div class="card-body">
                        <i class="fas fa-history fa-3x mb-3"></i>
                        <h5 class="card-title font-weight-bold">Recent Activities</h5>
                        <p class="text-muted">
                            Activity tracking is coming soon! Stay updated with your progress.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Support -->
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-sm border-success">
                    <div class="card-body">
                        <i class="fas fa-life-ring fa-3x mb-3"></i>
                        <h5 class="card-title font-weight-bold">Support</h5>
                        <p class="text-muted">
                            We're here to help! Support options will be available shortly.
                        </p>
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
</body>
</html>