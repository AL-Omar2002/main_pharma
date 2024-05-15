<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pharmacy Management System</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<style>
    /* Reset default margin and padding */
    body, html {
        margin: 0;
        padding: 0;
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        color: #333;
        background-color: #f5f5f5;
    }

    /* Container for the entire page content */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        position: relative; /* Ensure relative positioning for modal */
    }

    /* Header styles */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .header h1 {
        color: #007bff;
        font-weight: bold;
        font-size: 32px;
    }

    /* Table styles */
    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: #fff;
        text-transform: uppercase;
    }

    /* Button styles */
    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        color: #fff;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-success {
        background-color: #28a745;
    }

    .btn-info {
        background-color: #17a2b8;
    }

	.btn-cancel {
        background-color: #6c757d; /* Different color for Cancel button */
    }

    .btn:hover {
        opacity: 0.8;
    }

    /* Modal styles */
    .modal {
        display: none; /* Hide the modal by default */
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
    }

    .modal-content {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        padding: 20px;
        width: 400px; /* Adjust width as needed */
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"], input[type="number"], input[type="date"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
    }

    /* Responsive layout */
    @media (max-width: 768px) {
        .header {
            flex-direction: column;
            text-align: center;
        }
        .header h1 {
            font-size: 28px;
        }
        .header .btn {
            margin-top: 10px;
        }
        .modal-content {
            width: 90%; /* Adjust width for smaller screens */
        }
    }
</style>
</head>
<body>

<div class="container">
    <!-- Header section -->
    <div class="header">
        <h1>OUR Pharmacy</h1>
        <div>
            <a href="#" class="btn btn-primary" id="addMedicineBtn">
                <i class="fa fa-plus"></i> Add New Medicine
            </a>
            <a href="delete_all_records.php" class="btn btn-danger ml-2">
                <i class="fa fa-trash"></i> Delete All Records
            </a>
            <a href="generate_report.php" class="btn btn-info ml-2">
                <i class="fa fa-file-text-o"></i> Generate Report
            </a>
        </div>
    </div>

    <!-- Table section -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>Count</th>
                <th>Price</th>
                <th>Expiration Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- PHP loop for table data -->
            <?php
            include 'dbconn.php';
            $query = 'SELECT * FROM user';
            $mysqliquery = mysqli_query($conn, $query);
            while ($result = mysqli_fetch_assoc($mysqliquery)) {
            ?>
            <tr>
                <td><?php echo $result['name']; ?></td>
                <td><?php echo $result['company']; ?></td>
                <td><?php echo $result['count']; ?></td>
                <td><?php echo $result['price']; ?></td>
                <td><?php echo $result['expiration_date']; ?></td>
                <td>
                    <a href="update.php?id=<?php echo $result['id']; ?>" class="btn btn-info btn-sm">
                        <i class="fa fa-pencil"></i> Update
                    </a>
                    <a href="delete.php?ids=<?php echo $result['id']; ?>" class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i> Delete
                    </a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Add Medicine Modal -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <form method="POST" action="insert.php">
            <div class="modal-header">
                <h2 class="modal-title">Add Medicine</h2>
                <button type="button" class="close" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" id="company" name="company" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="count">Count</label>
                    <input type="number" id="count" name="count" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" id="price" name="price" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="expiration_date">Expiration Date</label>
                    <input type="date" id="expiration_date" name="expiration_date" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" id="cancelModal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-success">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap and jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // Show the modal when the "Add New Medicine" button is clicked
        $('#addMedicineBtn').click(function(e) {
            e.preventDefault();
            $('.modal').fadeIn(); // Display the modal
        });

        // Close the modal when the close button or outside the modal is clicked
        $('#closeModal, #cancelModal').click(function() {
            $('.modal').fadeOut(); // Hide the modal
        });
    });
</script>
</body>
</html>
