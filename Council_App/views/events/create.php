<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 30px; background-color: #f4f6f9; color: #333; }
        .nav { margin-bottom: 15px; font-size: 16px; }
        .nav a { color: #1B365D; font-weight: bold; text-decoration: none; margin-right: 15px; }
        .header { background-color: #1B365D; color: #FFFFFF; padding: 20px; border-radius: 8px 8px 0 0; border-bottom: 4px solid #D4AF37; }
        .header h2 { margin: 0; }
        .container { background: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; max-width: 600px; margin: auto; }
        .content { padding: 30px; }
        
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; color: #1B365D; }
        .form-group input, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        
        .btn { padding: 10px 15px; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 14px; border: none; cursor: pointer; display: inline-block; }
        .btn-save { background-color: #28a745; color: #FFFFFF; width: 100%; font-size: 16px; margin-top: 10px; }
        .btn-cancel { background-color: #6c757d; color: #FFFFFF; margin-top: 10px; text-align: center; width: 100%; box-sizing: border-box; }
        
        /* Layout for the API status text */
        .location-wrapper { display: flex; align-items: center; gap: 10px; }
        #api-status { font-size: 13px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="index.php?action=index">Members Management</a> | 
        <a href="index.php?action=events">Events & Attendance</a>
    </div>

    <div class="container">
        <div class="header">
            <h2>Add New Event</h2>
        </div>
        <div class="content">
            <form method="POST" action="index.php?action=event_create">
                
                <div class="form-group">
                    <label>Event Title</label>
                    <input type="text" name="title" required>
                </div>
                
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3"></textarea>
                </div>
                
                <div class="form-group">
                    <label>Event Date</label>
                    <input type="date" name="event_date" required>
                </div>
                
                <div class="form-group">
                    <label>Location (City/Municipality)</label>
                    <div class="location-wrapper">
                        <!-- Input bound to the datalist -->
                        <input type="text" name="location" id="location-input" list="locations-list" placeholder="Type to search..." required autocomplete="off">
                        <!-- API Loading/Error Status Indicator -->
                        <span id="api-status" style="color: #1B365D;">Loading cities...</span>
                    </div>
                    <!-- Empty datalist to be filled by JavaScript -->
                    <datalist id="locations-list"></datalist>
                </div>
                
                <button type="submit" class="btn btn-save">Save Event</button>
                <a href="index.php?action=events" class="btn btn-cancel">Cancel</a>
            </form>
        </div>
    </div>

    <!-- Asynchronous API Fetch Script -->
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const statusText = document.getElementById('api-status');
            const dataList = document.getElementById('locations-list');

            try {
                // Fetch JSON data for Philippine cities from the free PSGC API
                const response = await fetch('https://psgc.gitlab.io/api/cities/064501000/barangays/');

                // Handle server errors
                if (!response.ok) {
                    throw new Error('API Server error');
                }

                const cities = await response.json();

                // Handle empty or invalid response
                if (!cities || cities.length === 0) {
                    statusText.style.color = "red";
                    statusText.innerText = "No data found.";
                    return;
                }

                // Populate the datalist options with the fetched city names
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.name;
                    dataList.appendChild(option);
                });

                // Update status on success
                statusText.style.color = "#28a745"; // Green
                statusText.innerText = "✓ Ready";

            } catch (error) {
                // Handle total failures (e.g., no internet connection)
                statusText.style.color = "red";
                statusText.innerText = "Connection failed. Please type manually.";
                console.error("API Error:", error);
            }
        });
    </script>
</body>
</html>