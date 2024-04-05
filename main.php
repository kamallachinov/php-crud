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
                        <div class="d-flex justify-content-start align-items-center  mt-3 gap-2">
                            <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <?php include 'post_data.php' ?>


    <script>
    function fetchData() {
        fetch('fetch_data.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Response error');
                }
                console.log(response);
                return response.json();
            })
            .then(data => {
                console.log(data)
                let tableBody = document.querySelector('table tbody');
                tableBody.innerHTML = ''; // Clear table body

                // Loop through in the JSON data and create table rows
                data.forEach(row => {
                    let tr = document.createElement('tr');
                    tr.innerHTML = `<td>${row.id}</td><td><input type='text' class='form-control' value='${row.name}' /></td>
                                    <td><div class='btn-group'>
                                        <form action='update_data.php' method='POST'>
                                            <input type='hidden' name='id' value='${row.id}'>
                                            <input type='hidden' name='name' value='${row.name}'>
                                            <button type='submit' class='btn btn-primary' name='update'>Update</button>
                                        </form>
                                        <form action='delete.php' method='POST' onsubmit='return confirmDelete();'>
                                            <input type='hidden' name='id' value='${row.id}'>
                                            <button type='submit' class='btn btn-danger ml-2' name='delete'>Delete</button>
                                        </form>
                                    </div></td>`;
                    tableBody.appendChild(tr);
                });
            })
            .catch(error => console.error('There was a problem:', error));
    }
    fetchData();
    </script>



    <!-- jQuery library (required) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper.js (required) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>