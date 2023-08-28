<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technical test</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <style>
        /* Additional CSS for responsiveness */
        .container {
            max-width: 800px; /* Adjust the max-width as needed */
            padding:20px;
        }
    </style>
    <div class="container mt-3">
        <h2 class="text-center">TECHNICAL TEST - PAEZ</h2>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" pattern="[A-Za-z0-9]+" required>
            </div>
            <div class="mb-3">
                <label for="unit" class="form-label">Unit</label>
                <input type="text" class="form-control" id="unit" name="unit" pattern="[A-Za-z0-9]+" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="mb-3">
                <label for="expiryDate" class="form-label">Date of Expiry</label>
                <input type="date" class="form-control" id="expiryDate" name="expiryDate" required>
            </div>
            <div class="mb-3">
                <label for="inventory" class="form-label">Available Inventory</label>
                <input type="number" class="form-control" id="inventory" name="inventory" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="url" class="form-control" id="image" name="image" required>
            </div>
            <div class="mb-3 text-center">
                <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $("#submitBtn").click(function(e) {
                e.preventDefault()
                var name = $("#name").val();
                var unit = $("#unit").val();
                var price = $("#price").val();
                var expD = $("#expiryDate").val();
                var avInv = $("#inventory").val();
                var link = $("#image").val();

                $.ajax({
                    type: "POST",
                    url: "process.php",
                    data: { name: name, 
                            unit: unit,
                            price: price,
                            expD: expD,
                            avInv: avInv,
                            link: link
                        },
                    success: function(response) {
                        if (response) {
                            window.location.href = 'display.php'
                        }else{
                            alert('Error please try again later.')
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
