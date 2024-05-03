<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD With Ajax</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <h1 class="fs-3 text-center">User Info</h1>
            <button class="btn btn-success" id="AddNew">Add New User</button>
            <table class="table" id="studentTable">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentModalLabel">User Info</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                     <!-- form -->
                <form id="studentForm">
                    <!-- studentId -->
                <div class="form-group">
                    <input type="text" name="id" id="id" class="form-control" placeholder="Enter student id" >
                </div>
                  <!-- student name -->
                <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter student name" >
                </div>

                   <!-- studentclass -->
                   <div class="form-group">
                    <input type="text" name="class" id="class" class="form-control" placeholder="Enter student class" >
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>

                </form>
               
        </div>
    </div>
</div>
<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- javascript link -->
<script src="main.js"></script>

</body>
</html>
