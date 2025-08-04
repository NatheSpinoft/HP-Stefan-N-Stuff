<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stefan N Stuff - Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="styles.css" />
    
</head><body>

    <header class="header">
        <img src="homepageimg.png" alt="Homepage Icon">
        <h1>Stefan N Stuff</h1>
    </header>

    <nav class="navbar navbar-expand-lg nav-bar sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="HP Stefan N Stuff.html">Home</a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">Projects</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="receipt.html">Receipt system</a></li>
                            <li><a class="dropdown-item" href="inventory.html">Inventory System</a></li>
                            <li><a class="dropdown-item" href="projects.html">Other</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="container-fluid main-content">
        <section class="left">
            <div class="card card-custom">
                <h4>Cash Flow</h4>
<!-- CASH FLOW PART --> 
        <?php
        //Prepare Connection
if ($_SERVER["REQUEST_METHOD"] =="POST") {

        $dns = "mysql:host=localhost;dbname=cashflowdb";
        $username = "tester";
        $password = "password";

        try{
            $db = new PDO($dns,$username, $password);

        }catch (Exception $e) {
            echo "Database error: " . $e->getMessage();
            exit;
        }

        //Get posted values
        $date = $_POST['trans_date'];
        $desc = $_POST['description'];
        $amount = $_POST['amount'];
        $type = $_POST['type'];
        $cat = $_POST['category'];

        // Simple insert
        $sql = "INSERT INTO transactions (trans_date, description, amount, type, category, created_at)
            VALUES (:date, :desc, :amount, :type, :cat, NOW())";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':desc', $desc);
        $stmt->bindParam(':amount', $amount);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':cat', $cat);

        $stmt->execute();
}



        ?>
<form method="POST" class="mb-4">
    <div class="row g-2">
        <div class="col-md-2">
            <input type="date" name="trans_date" class="form-control" required>
        </div>
        <div class="col-md-2">
            <input type="text" name="description" class="form-control" placeholder="Description" required>
        </div>
        <div class="col-md-2">
            <input type="number" step="0.01" name="amount" class="form-control" placeholder="Amount" required>
        </div>
        <div class="col-md-2">
            <select name="type" class="form-select" required>
                <option value="income">Income</option>
                <option value="expense">Expense</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="text" name="category" class="form-control" placeholder="Category" required>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Add Transaction</button>
        </div>
    </div>
</form>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <td>ID</td>
                <td>Date</td>
                <td>Description</td>
                <td>Amount</td>
                <td>Type</td>
                <td>Category</td>
                <td>Date Time</td>
            </tr>
        </thead>
        <tbody>
    <?php
        //Prepare Connection
        $dns = "mysql:host=localhost;dbname=cashflowdb";
        $username = "tester";
        $password = "password";

        //Establish Connection
        try {
            $db = new PDO($dns,$username,$password);
        }catch(Exception $e){
            $error_message = $e->getMessage();
            echo "<p>Error Message: $error_message</p>";
        }

        //Display Table
        $query = "SELECT * FROM transactions";
        $statement = $db->prepare($query);
        $statement->execute();
        
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
            echo "<td>" . htmlspecialchars($row['trans_date']) . "</td>";
            echo "<td>" . htmlspecialchars($row['description']) . "</td>";
            echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
            echo "<td>" . htmlspecialchars($row['type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['category']) . "</td>";
            echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
            echo "</tr>";
        }
        //Close Table

        $statement->closeCursor();
    ?>
    </tbody>
    </table>




<!-- CASH FLOW END --> 
            </div>
        </section>
        <aside class="right">
            <div class="card card-custom">
                <h4>News & Updates</h4>
                <p>Stay tuned for new project launches and features.</p>
            </div>
            <div class="card card-custom">
                <h4>AI Tools</h4>
                <ul class="list-unstyled">
                    <li><i class="fas fa-robot"></i> <a href="https://chat.openai.com" target="_blank">ChatGPT</a></li>
                    <li><i class="fas fa-paint-brush"></i> <a href="https://openai.com/dall-e" target="_blank">DALL·E</a></li>
                    <li><i class="fas fa-code"></i> <a href="https://github.com/features/copilot" target="_blank">GitHub Copilot</a></li>
                    <li><i class="fas fa-language"></i> <a href="https://www.deepl.com" target="_blank">DeepL</a></li>
                    <li><i class="fas fa-microphone"></i> <a href="https://www.elevenlabs.io" target="_blank">ElevenLabs</a></li>
                    <li><i class="fas fa-brain"></i> <a href="https://huggingface.co" target="_blank">Hugging Face</a></li>
                    <li><i class="fas fa-search"></i> <a href="https://perplexity.ai" target="_blank">Perplexity AI</a></li>
                    <li><i class="fas fa-image"></i> <a href="https://www.midjourney.com" target="_blank">Midjourney</a></li>
                </ul>
            </div>
            <div class="card card-custom shadow-sm p-3 mb-4 bg-white rounded" id="weather-card">
            <h4 class="card-title mb-3">Live Weather</h4>
            <div id="weather-content" class="d-flex align-items-center">
                <div id="weather-icon" class="me-3"></div>
                <div>
                <p id="weather-location" class="mb-1 fw-bold">Loading...</p>
                <p id="weather-temp" class="mb-1 fs-4"></p>
                <p id="weather-desc" class="mb-0 text-capitalize text-muted"></p>
                </div>
            </div>
            

        </aside>
    </main>

    <script src="config.js"></script>
    <script>
        async function fetchWeather() {
            try {
                const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=Ottawa&appid=${WEATHER_API_KEY}&units=metric`);
                const data = await response.json();

                // Set text content
                document.getElementById('weather-location').textContent = data.name;
                document.getElementById('weather-temp').innerHTML = `${Math.round(data.main.temp)}&deg;C`;
                document.getElementById('weather-desc').textContent = data.weather[0].description;

                // Set weather icon
                const iconCode = data.weather[0].icon;
                const iconUrl = `https://openweathermap.org/img/wn/${iconCode}@2x.png`;
                document.getElementById('weather-icon').innerHTML = `<img src="${iconUrl}" alt="Weather icon">`;

            } catch (error) {
                document.getElementById('weather-content').innerText = 'Unable to load weather data.';
                console.error(error);
            }
        }
        fetchWeather();

</script>

</body>
</html>
