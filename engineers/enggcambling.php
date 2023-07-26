<?php include('engineersheader.php'); ?>

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <!-- <h1 class="h3 mb-0 text-gray-800">Add Engineers</h1> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="engineersindex.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="enggdpr.php">DPR</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cambling</li>
        </ol>
    </div>

    <div class="row">

        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <!-- <h6 class="m-0 font-weight-bold text-primary">Travelling Expense</h6> -->


                    <!-- <input class="form-control" type="text" id="searchBar" style="display: none;" placeholder="Search here..."> -->

                    <div class="autocomplete" id="autocompleteDiv" style="display: none;">
                        <input class="form-control" type="text" id="searchBox" placeholder="Enter your search query" onkeyup="getGoodsSuggestions(this.value)">
                        <div class="suggestions" id="suggestionsList"></div>
                    </div>


                    <script>
                        var selectedItems = [];

                        function showSuggestions(suggestions) {
                        var suggestionsList = document.getElementById("suggestionsList");
                        suggestionsList.innerHTML = "";

                        if (suggestions.length > 0) {
                            var ul = document.createElement("ul");

                            for (var i = 0; i < suggestions.length; i++) {
                            var li = document.createElement("li");
                            li.textContent = suggestions[i];
                            li.onclick = function() {
                                addToSelectedItems(this.textContent);
                                clearSearchBox();
                            };
                            ul.appendChild(li);
                            }

                            suggestionsList.appendChild(ul);
                        }
                        }

                        function getGoodsSuggestions(str) {
                        if (str.length === 0) {
                            showSuggestions([]);
                        } else {
                            var xhr = new XMLHttpRequest();
                            xhr.onreadystatechange = function() {
                            if (this.readyState === 4 && this.status === 200) {
                                var suggestions = JSON.parse(this.responseText);
                                showSuggestions(suggestions);
                            }
                            };
                            xhr.open("GET", "../BDE/save_photo.php?q=" + str, true);
                            xhr.send();
                        }
                        }

                        function addToSelectedItems(item) {
                        var selectedItem = selectedItems.find(function(selected) {
                            return selected.name === item;
                        });

                        if (selectedItem) {
                            selectedItem.quantity++;
                        } else {
                            selectedItems.push({ name: item, quantity: 1 });
                        }

                        displaySelectedItems();
                        }

                        function removeFromSelectedItems(item) {
                        var selectedItemIndex = selectedItems.findIndex(function(selected) {
                            return selected.name === item;
                        });

                        if (selectedItemIndex > -1) {
                            selectedItems[selectedItemIndex].quantity--;

                            if (selectedItems[selectedItemIndex].quantity === 0) {
                            selectedItems.splice(selectedItemIndex, 1);
                            }
                        }

                        displaySelectedItems();
                        }

                        function displaySelectedItems() {
                        var selectedItemsList = document.getElementById("selectedItemsList");
                        selectedItemsList.innerHTML = "";

                        if (selectedItems.length > 0) {
                            var ul = document.createElement("ul");

                            for (var i = 0; i < selectedItems.length; i++) {
                            var li = document.createElement("li");
                            var spanName = document.createElement("span");
                            spanName.textContent = selectedItems[i].name;
                            var spanQuantity = document.createElement("span");
                            spanQuantity.textContent = selectedItems[i].quantity;
                            var buttonIncrease = document.createElement("button");
                            buttonIncrease.textContent = "+";
                            buttonIncrease.onclick = function() {
                                addToSelectedItems(this.parentNode.firstChild.textContent);
                            };
                            var buttonDecrease = document.createElement("button");
                            buttonDecrease.textContent = "-";
                            buttonDecrease.onclick = function() {
                                removeFromSelectedItems(this.parentNode.firstChild.textContent);
                            };

                            li.appendChild(spanName);
                            li.appendChild(spanQuantity);
                            li.appendChild(buttonIncrease);
                            li.appendChild(buttonDecrease);
                            ul.appendChild(li);
                            }
                            selectedItemsList.appendChild(ul);
                        }
                        }

                        function clearSearchBox() {
                        document.getElementById("searchBox").value = "";
                        document.getElementById("suggestionsList").innerHTML = "";
                        }

                        function insertSelectedItems() {
                            if (selectedItems.length > 0) {
                                var xhr = new XMLHttpRequest();
                                xhr.open("POST", "../BDE/save_photo.php", true);
                                xhr.setRequestHeader("Content-Type", "application/json");
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState === 4) {
                                        if (xhr.status === 200) {
                                            alert("Item saved successfully.");
                                            window.location.href = "enggdpr.php";
                                            clearSelectedItems();
                                        } else {
                                            alert("Failed to save Cambling item.");
                                        }
                                    }
                                };
                                xhr.send(JSON.stringify(selectedItems));
                            }
                        }

                    </script>                    



                    <script>
                        function toggleAutocomplete() {
                            var autocompleteDiv = document.getElementById('autocompleteDiv');
                            autocompleteDiv.style.display = (autocompleteDiv.style.display === 'none') ? 'block' : 'none';
                        }
                    </script>
                    
                    <div class="col-3 col-md-3 col-lg-3">
                        <!-- <a href="Travelexp.php" name="submit" class="btn btn-primary"><i class="fas fa-plus"></i></a> -->
                        <button class="btn btn-primary" id="showAutocompleteBtn" onclick="toggleAutocomplete()"><i class="fas fa-plus"></i></button>
                    </div>
                </div>

                <div class="selected-items py-2 ml-2">
                    <!-- <h2>Selected Items</h2> -->
                    <div id="selectedItemsList"></div>
                    <button class="btn btn-primary" onclick="insertSelectedItems()">Save</button>
                </div>

                <div class="table-responsive">
                    <div style="height: 500px;overflow-y:scroll;">

                         <table class="table align-items-center table-flush">

                         <?php
                        $sql = "SELECT name, quantity FROM goods_item ORDER BY date DESC";
                        $result = $conn->query($sql);

                        $items = array();
                        while ($row = $result->fetch_assoc()) {
                            $items[] = $row;
                        }
                        ?>

                        <ul class="goods-list list-group">
                        <?php foreach ($items as $item): ?>
                            <li class="list-group-item">
                            <span><?php echo $item['name']; ?></span>
                            <input class="form-control" type="number" value="<?php echo $item['quantity']; ?>" disabled>
                            </li>
                        <?php endforeach; ?>
                        </ul>



                          <!--  <thead class="thead-light">
                                <tr>
                                    <th>SN</th>
                                    <th>Site Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Check Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = "SELECT id, site_name, date, status FROM texpense";
                                    $result = mysqli_query($conn, $query);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td>' . $row['id'] . '</td>';
                                            echo '<td>' . $row['site_name'] . '</td>';
                                            echo '<td>' . $row['date'] . '</td>';
                                            echo '<td>' . $row['status'] . '</td>';
                                            echo '<td><a href="checkdetail.php?id=' . $row['id'] . '">Check Detail</a></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No data found</td></tr>';
                                    }
                                ?>
                            </tbody>-->
                        </table> 
                        
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>

    </div>
</div>
<?php include('engineersfooter.php'); ?>