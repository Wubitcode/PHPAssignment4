<?php
// Include the common header file
// This usually contains the HTML <head>, navigation bar, and opening layout
require __DIR__ . '/../header.php';
?>

<div class="container mt-5">
  <!-- Bootstrap alert to display a validation error message -->
  <div class="alert alert-danger">
    <h4 class="alert-heading">Validation Error</h4>
    <!-- Message explaining what went wrong -->
    <p>All fields are required. Please go back and correct the form.</p>
  </div>

  <!-- Button that sends the user back to the previous page -->
  <!-- javascript:history.back() returns to the form the user came from -->
  <a href="javascript:history.back()" class="btn btn-secondary">
    Go Back
  </a>
</div>

<?php
// Include the common footer file
// This usually closes the HTML structure and loads scripts
require __DIR__ . '/../footer.php';
?>
