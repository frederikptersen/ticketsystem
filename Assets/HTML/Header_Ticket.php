<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Ticketsytem</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-1.13.8/datatables.min.js"></script>
        <link rel="icon" type="image/x-icon" href="./Assets/IMG/ticketing-system.ico" />
    </head>
    <body>
        <header class="py-3 border-bottom">
            <div class="container d-flex flex-wrap justify-content-center">
              <a href="index.php" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                <img src="./Assets/IMG/ticketing-system.ico" class="bi me-2" height="32px">
                <span class="fs-4">Ticketsytem</span>
              </a>
              <a href="ticket_create.php"><button type="button" class="btn btn-success">Create Ticket</button></a>
            </div>
        </header>
          <?=$ErrorGen?>
    </body>
</html>