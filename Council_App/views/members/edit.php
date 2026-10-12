<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Council Member</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 30px; background-color: #f4f6f9; }
        .form-container { max-width: 500px; margin: 0 auto; background: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); overflow: hidden; }
        .header { background-color: #1B365D; color: #FFFFFF; padding: 20px; border-bottom: 4px solid #D4AF37; }
        .header h2 { margin: 0; }
        form { padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #1B365D; }
        input[type="text"], input[type="email"] { width: 100%; padding: 10px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        input:focus { border-color: #D4AF37; outline: none; }
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
            <h2>Edit Council Member</h2>
        </div>
        <?php if ($member): ?>
            <form method="POST" action="index.php?action=edit&id=<?= htmlspecialchars($member['id']) ?>">
                <div class="form-group">
                    <label>Student ID:</label>
                    <input type="text" name="student_id" value="<?= htmlspecialchars($member['student_id']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Full Name:</label>
                    <input type="text" name="full_name" value="<?= htmlspecialchars($member['full_name']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Position:</label>
                    <input type="text" name="position" value="<?= htmlspecialchars($member['position']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($member['email']) ?>" required>
                </div>
                <button type="submit" class="btn btn-submit">Update Member</button>
                <a href="index.php?action=index" class="btn btn-cancel">Cancel</a>
            </form>
        <?php else: ?>
            <div style="padding: 20px;">
                <p style="color: red;">Member not found.</p>
                <a href="index.php?action=index" class="btn btn-cancel">Back to Members List</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>