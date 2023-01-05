<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">

<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />




    <title>Booking Admin</title>
  </head>
  <body>

 
    <div class="container mt-5">
      <h1>Booking List</h1>
      <table id="booking-table" class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Service</th>
            <th>Date</th>
            <th>Time</th>
            <th>Delete</th>
            <th>Edit</th>


    

          </tr>

          
        </thead>
        <tbody>
          <!-- Fetch the booking data and insert into the table -->
          <?php
            // Connect to the database
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "bookdb";

            
            $conn = mysqli_connect($host, $username, $password, $dbname);

            if (!$conn) {
              die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch the booking data
            $sql = "SELECT * FROM appointments";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              // Output the data for each row
              while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>" . $row['service'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['time'] . "</td>";
                echo "<td><button class='btn btn-danger delete-btn' data-id='" . $row['id'] . "'>Delete</button></td>";
                echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a></td>";
                echo "</tr>";
                
              }
            } else

            {
            echo "<tr>";
          echo "<td colspan='7'>No bookings found</td>";
          echo "</tr>";
              }
              
              mysqli_close($conn);
              ?>
                      </tbody>
                    </table>
                  </div>
              
                 <!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<!-- Buttons -->
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>

<!-- JSZip -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<!-- pdfmake -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<!-- Buttons HTML5 -->
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>


<script>
  document.querySelector("#export-button").addEventListener("click", function() {
    // handle export action here
  });
</script>

<script>
$('#booking-table').DataTable({
  dom: 'lBfrtip',
  lengthMenu: [ [10, 50, 100, -1], [10, 50, 100, "All"] ],
  buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
});






</script>

<script>
$(document).ready(function() {
  $('.delete-btn').on('click', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    // Display a pop-up notification asking the user to confirm the delete action
    if (confirm("Are you sure you want to delete this booking?")) {
      // If the user confirms, send a DELETE request to delete.php
      $.ajax({
        url: 'delete.php',
        type: 'POST',
        data: {
          id: id
        },
        success: function(response) {
          // Display a notification that the booking was deleted successfully
          toastr.success('Booking deleted successfully');
          // Refresh the table data
          $('#booking-table').DataTable().ajax.reload();
        },
        error: function(xhr, ajaxOptions, thrownError) {
          // Display an error notification if there was an issue with the delete request
          toastr.error(thrownError);
        }
      });
    }
  });
});
</script>


</body>
</html>
