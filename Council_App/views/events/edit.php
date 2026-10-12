<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Council Event</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 30px; background-color: #f4f6f9; }
        .form-container { max-width: 500px; margin: 0 auto; background: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background-color: #1B365D; color: #FFFFFF; padding: 20px; border-bottom: 4px solid #D4AF37; }
        .header h2 { margin: 0; }
        form { padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #1B365D; }
        input[type="text"], input[type="date"], textarea { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; font-family: inherit; }
        input:focus, textarea:focus { border-color: #D4AF37; outline: none; }
        .btn { padding: 10px 18px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-submit { background-color: #D4AF37; color: #1B365D; }
        .btn-submit:hover { background-color: #c49f27; }
        .btn-cancel { background-color: #1B365D; color: #FFFFFF; margin-left: 10px; }
        .btn-cancel:hover { background-color: #132743; }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="header">
            <h2>Edit Council Event</h2>
        </div>
        <?php if ($event): ?>
            <form method="POST">
                <div class="form-group">
                    <label>Event Title:</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($event['title']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Description:</label>
                    <textarea name="description" rows="3" required><?= htmlspecialchars($event['description']) ?></textarea>
                </div>
                <div class="form-group">
                    <label>Event Date:</label>
                    <input type="date" name="event_date" value="<?= htmlspecialchars($event['event_date']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Location:</label>
                    <input type="text" name="location" value="<?= htmlspecialchars($event['location']) ?>" required>
                </div>
                <button type="submit" class="btn btn-submit">Update Event</button>
                <a href="index.php?action=events" class="btn btn-cancel">Cancel</a>
            </form>
        <?php else: ?>
            <div style="padding: 20px;">
                <p style="color: red;">Event not found.</p>
                <a href="index.php?action=events" class="btn btn-cancel">Back to Events List</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>