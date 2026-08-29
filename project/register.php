<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container text-center mt-4" style="max-width: 600px">
        <h1 class="h3 mb-3">Register</h1>

        <form action="actions/create.php" method="post" class="mb-3">
            <input type="text" class="form-control mb-2" placeholder="Name" name="name" required>
            <input type="email" class="form-control mb-2" placeholder="Email" name="email" required>
            <input type="text" class="form-control mb-2" placeholder="Phone" name="phone" required>
            <textarea name="address" class="mb-2 form-control" placeholder="Address" required></textarea>
            <input type="password" class="form-control mb-2" placeholder="Password" name="password" required>
            <button class="btn btn-primary w-100">
                Register
            </button>
        </form>
        <a href="index.php">Login</a>
    </div>
</body>

</html>