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
    <div class="container mt-5">
        <h2 class="text-center mb-4">TECHNICAL TEST - PAEZ</h2>
        <div class="mb-3 text-end"> <!-- Add a margin-bottom and text alignment class -->
            <button class="btn btn-primary" id="addProductBtn">Add Product</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="productTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Date of Expiry</th>
                        <th>Available Inventory</th>
                        <th>Available Inventory Cost</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $.ajax({
                    type: "GET",
                    url: "process.php",
                    
                    success: function(response) {

                        var tableBody = $("#productTable tbody");
                        var jsonData = JSON.parse(response);

                        jsonData.forEach(function(item) {
                            var cost = item.AvailableIn * item.price;
                            var row = $("<tr></tr>");
                            row.append(`<td>${item.name}</td>`);
                            row.append(`<td>${item.unit}</td>`);
                            row.append(`<td>${item.price}</td>`);
                            row.append(`<td>${item.DateExp}</td>`);
                            row.append(`<td>${item.AvailableIn}</td>`);
                            row.append(`<td>${cost}</td>`);
                            row.append(`<td class="ellipsis-cell"><img src="${item.imageLink}" alt="${item.name}" height="50"></td>`);
                            row.append(`
                                <td>
                                    <button class="btn btn-warning up action" id="${item.id}">Update</button>
                                    <button class="btn btn-danger del action" id="${item.id}">Delete</button>
                                </td>
                            `);
                            tableBody.append(row);
                        });
                    }
                });

            $(document).on("click", ".up", function() {
                var id = $(this).attr('id');
                var row = $(this).closest("tr");

                var imageCell = row.find("td:nth-last-child(2)");
                var imageSrc = imageCell.find("img").attr("src");

                row.find("td:not(:last-child):not(:nth-last-child(3))").each(function() {
                    if ($(this).is(imageCell)) {
                        $(this).html(`<input type="text" value="${imageSrc}">`);
                    } else {
                        var cellValue = $(this).text();
                        $(this).html(`<input type="text" value="${cellValue}">`);
                    }
                });
                var saveButton = $('<button class="btn btn-success save" data-id="' + id + '">Save</button>');
                $(this).replaceWith(saveButton);
            });
            $(document).on("click", ".del", function() {
                var id = $(this).attr('id');
                var row = $(this).closest("tr");
                $.ajax({
                    type: "DELETE",
                    url: "process.php",
                    data: { id: id },
                    success: function(response) {
                        alert(response);
                        row.remove();
                    }
                });
            });

            $(document).on("click", ".save", function() {
                var id = $(this).data('id');
                var row = $(this).closest("tr");

                var inputValues = [];
                row.find("input[type='text']").each(function() {
                    inputValues.push($(this).val());
                });
                console.log("Input Values:", inputValues);

                $.ajax({
                    type: "PUT",
                    url: "process.php", // Change to your update script URL
                    data: { 
                            id: id,
                            name: inputValues[0], 
                            unit: inputValues[1],
                            price: inputValues[2],
                            expD: inputValues[3],
                            avInv: inputValues[4],
                            link: inputValues[5]
                        },
                    success: function(response) {
                        alert(response);
                    }
                });
                
                //Custom
                var cost = inputValues[2] * inputValues[4];
                var imageCell = row.find("td:nth-last-child(2)");
                var costCell = row.find("td:nth-last-child(3)");
                costCell.html(`<td>${cost}</td>`)
                imageCell.html(`<img src="${inputValues[inputValues.length - 1]}" alt="${inputValues[0]}" height="50">`);

                row.find("input[type='text']").each(function(index) {
                    var inputValue = inputValues[index];
                    $(this).replaceWith(inputValue);
                });

                var updateButton = $('<button class="btn btn-warning up" data-id="' + id + '">Update</button>');
                $(this).replaceWith(updateButton);
            });

            $(document).on("click", "#addProductBtn", function() {
                window.location.href = 'addform.php'
            });
        });
    </script>
</body>
</html>
