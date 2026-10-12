<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Council Events</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 30px; background-color: #f4f6f9; color: #333; }
        .header { background-color: #1B365D; color: #FFFFFF; padding: 20px; border-radius: 8px 8px 0 0; border-bottom: 4px solid #D4AF37; }
        .header h2 { margin: 0; }
        .nav { margin-bottom: 15px; }
        .nav a { color: #1B365D; font-weight: bold; text-decoration: none; margin-right: 15px; }
        .nav a.active { text-decoration: underline; color: #D4AF37; }
        .container { background: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; }
        .content { padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background-color: #1B365D; color: #D4AF37; padding: 12px; text-align: left; }
        td { border-bottom: 1px solid #e0e0e0; padding: 12px; }
        .btn { padding: 8px 14px; text-decoration: none; border-radius: 4px; font-weight: bold; font-size: 14px; display: inline-block; }
        .btn-add { background-color: #D4AF37; color: #1B365D; margin-bottom: 15px; }
        .btn-edit { background-color: #1B365D; color: #FFFFFF; }
        .btn-track { background-color: #28a745; color: #FFFFFF; }
        .btn-delete { background-color: #c9302c; color: #FFFFFF; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="index.php?action=index">Members Management</a> | 
        <a href="index.php?action=events" class="active">Events & Attendance</a>
    </div>
    <div class="container">
        <div class="header"><h2>Council Events</h2></div>
        <div class="content">
            <a href="index.php?action=event_create" class="btn btn-add">+ Add Event</a>
            <table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Location</th>
            <th>Holiday Info</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $e): ?>
            <tr>
                <td><?= htmlspecialchars($e['title']) ?></td>
                <td><?= htmlspecialchars($e['description']) ?></td>
                <td><?= htmlspecialchars($e['event_date']) ?></td>
                <td><?= htmlspecialchars($e['location']) ?></td>
                
                <!-- NEW HOLIDAY API COLUMN -->
                <td style="width: 200px;">
                    <button class="btn btn-search" onclick="checkHoliday('<?= htmlspecialchars($e['event_date']) ?>', this)">
                        Check Holiday
                    </button>
                    <div class="api-result" style="margin-top: 5px; font-size: 13px; font-weight: bold;"></div>
                </td>

                <td>
                    <a href="index.php?action=attendance_log&event_id=<?= $e['id'] ?>" class="btn btn-track">Attendance</a>
                    <a href="index.php?action=event_edit&id=<?= $e['id'] ?>" class="btn btn-edit">Edit</a>
                    <a href="index.php?action=event_delete&id=<?= $e['id'] ?>" class="btn btn-delete" onclick="return confirm('Delete event?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center; color: #777;">No matching events found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
        </div>
    </div>
    <script>
    // Async function to check if the event date is a public holiday
    async function checkHoliday(eventDate, buttonElement) {
        // Find the div right next to the button where we will show the text
        const resultDiv = buttonElement.nextElementSibling;
        
        // 1. Show a loading message while waiting for a response
        resultDiv.style.color = "#1B365D";
        resultDiv.innerText = "Loading data...";
        buttonElement.disabled = true; // prevent double clicking

        try {
            // Extract the year from the event date (format: YYYY-MM-DD)
            const year = eventDate.split('-')[0];
            
            // Call the free Nager.Date API for Philippine (PH) holidays
            const apiUrl = `https://date.nager.at/api/v3/PublicHolidays/${year}/PH`;
            
            // Fetch the JSON data asynchronously
            const response = await fetch(apiUrl);
            
            // 2. The API or server is down or times out (Error handling)
            if (!response.ok) {
                throw new Error("API Server error");
            }

            const holidays = await response.json();
            
            // 3. The response is empty or invalid (Error handling)
            if (!holidays || holidays.length === 0) {
                resultDiv.style.color = "red";
                resultDiv.innerText = "No data found for this year.";
                buttonElement.disabled = false;
                return;
            }

            // Search the JSON array to see if our eventDate matches any holiday date
            const holidayMatch = holidays.find(h => h.date === eventDate);

            // 4. Show the result inside your system
            if (holidayMatch) {
                resultDiv.style.color = "#28a745"; // Green text for holidays
                resultDiv.innerText = "🎉 " + holidayMatch.name;
            } else {
                resultDiv.style.color = "#6c757d"; // Gray text for normal days
                resultDiv.innerText = "Regular Day (No data found)";
            }

        } catch (error) {
            // Display friendly message if fetch fails completely (like no internet)
            resultDiv.style.color = "red";
            resultDiv.innerText = "Connection failed. Please try again later.";
            console.error("API Error:", error);
        } finally {
            // Re-enable the button once we are done
            buttonElement.disabled = false;
        }
    }
</script>
</body>
</html>