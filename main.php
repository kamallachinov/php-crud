<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Document</title>
</head>

<body>

    <div class="table-responsive">
        <div class="d-flex justify-content-center align-items-center flex-column pt-2">
            <h2>List of users </h2>
            <button type="button" class="btn btn-success " data-toggle="modal" data-target="#exampleModal">Add
                new</button>
        </div>
        <div class="p-3">
            <table class=" table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="post_data.php" method="POST">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" placeholder="Enter name" name="name">
                        <div class="d-flex justify-content-start align-items-center flex-row">
                            <button type="submit" class="btn btn-primary mr-2 my-2" name="submit">Save changes</button>
                            <button type="button" class="btn btn-secondary my-2" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <?php include 'post_data.php' ?>

    <!-- jQuery library (required) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
    function fetchData() {
        $.ajax({
            url: "fetch_data.php",
            type: "GET",
            success: function(data) {
                let tableBody = document.querySelector('table tbody');
                tableBody.innerHTML = '';

                if (data.length >= 0) {
                    // Looping through the JSON data and creating table rows
                    JSON.parse(data).forEach(row => {
                        let tr = document.createElement('tr');
                        let inputField = document.createElement('input');
                        inputField.type = 'text';
                        inputField.className = 'form-control';
                        inputField.value = row.name;
                        inputField.addEventListener('change', function() {
                            // Update the data-name attribute of the corresponding "Update" button
                            let updateBtn = tr.querySelector('.update-btn');
                            updateBtn.setAttribute('data-name', inputField.value);
                        });
                        tr.innerHTML = `<td>${row.id}</td><td></td><td>
                        <div class='btn-group'>
                            <button class='btn btn-primary update-btn' data-id='${row.id}' data-name='${row.name}'>Update</button>
                            <button class='btn btn-danger ml-2 delete-btn' data-id='${row.id}'>Delete</button>
                        </div>
                    </td>`;
                        tr.querySelector('td:nth-child(2)').appendChild(inputField);
                        tableBody.appendChild(tr);
                    });
                } else {
                    let tr = document.createElement("tr");
                    tr.innerHTML = `<td colspan='3'>${JSON.parse(data)[0].id}</td>`;
                    tableBody.appendChild(data);
                }
            },
            error: function(error) {
                console.error('There was a problem:', error);
            }
        });



    }
    document.querySelector('table').addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-btn')) {
            const id = event.target.getAttribute('data-id');
            window.location.reload();
            deleteData(id);
        }
    });
    document.querySelector('table').addEventListener('click', function(event) {
        if (event.target.classList.contains('update-btn')) {
            const id = event.target.getAttribute('data-id');
            const name = event.target.getAttribute('data-name');
            // console.log(id, name)
            updateData(id, name);
        }
    });
    fetchData();

    function deleteData(id) {
        let action = "dltRecord";
        $.ajax({
            url: "delete.php",
            type: "POST",
            data: {
                action: action,
                id: id
            },
            success: function(data) {
                alert(data);
            },
            error: function(error) {
                console.error('Error deleting record:', error);
            }
        });
    }

    function updateData(id, name) {
        let action = "updateRecord";
        console.log("Updating record with ID: " + id + ", Name: " + name);
        $.ajax({
            url: "update_data.php",
            type: "POST",
            data: {
                action: action,
                id: id,
                name: name
            },
            success: function(data) {
                console.log(data)
                alert(data);
            },
            error: function(error) {
                console.error('Error updating record:', error);
            }
        });
    }
    </script>




    <!-- Popper.js (required) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>